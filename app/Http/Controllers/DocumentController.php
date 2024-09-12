<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\ProcessDocumentImport;
use App\Models\Document;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::all();
        return view(
            'documents.index',
            compact('documents')
        );
    }

    public function import(Request $request)
    {
        $request->validate([
            'json_file' => 'required|file|mimes:json|max:2048',
        ]);

        $path = $request->file('json_file')->store('json_files');
        $json = Storage::get($path);

        $data = json_decode($json, true);

        if (!isset($data['exercicio']) || !isset($data['documentos'])) {
            return back()->withErrors(['O arquivo JSON está no formato incorreto.']);
        }

        foreach ($data['documentos'] as $document) {
            ProcessDocumentImport::dispatch($document);
        }

        return back()->with(
            'success',
            'Importação iniciada. Os documentos estão na fila para processamento.'
        );
    }

    public function showImportPage()
    {
        return view('documents.import');
    }
}
