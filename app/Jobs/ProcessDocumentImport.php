<?php

namespace App\Jobs;

use App\Models\Document;
use App\Models\Category;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessDocumentImport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $document;

    public function __construct(array $document)
    {
        $this->document = $document;
    }

    public function handle()
    {
        Document::create([
            'category_id' => $this->getCategoryId($this->document['categoria']),
            'title' => $this->document['titulo'],
            'contents' => $this->document['conteúdo'],
        ]);
    }

    protected function getCategoryId($categoryName)
    {
        return Category::firstOrCreate(['name' => $categoryName])->id;
    }
}
