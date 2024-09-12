@extends('layouts.app')

@section('title', 'Documentos Importados')

@section('content')
    <h1 class="text-center mb-5">Documentos Importados</h1>

    @if ($documents->isEmpty())
        <p class="text-center">Nenhum documento foi importado.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Categoria</th>
                    <th>Título</th>
                    <th>Conteúdo</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($documents as $document)
                    <tr>
                        <td>{{ $document->id }}</td>
                        <td>{{ $document->category->name }}</td>
                        <td>{{ $document->title }}</td>
                        <td>{{ $document->contents }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <a href="{{ route('welcome') }}" class="btn btn-secondary">Voltar ao Menu</a>
@endsection
