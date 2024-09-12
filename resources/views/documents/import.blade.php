@extends('layouts.app')

@section('title', 'Importar Arquivo JSON')

@section('content')
    <h1 class="text-center mb-5">Importar Arquivo JSON</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('documents.import') }}" method="POST" enctype="multipart/form-data" class="mb-3">
        @csrf
        <div class="mb-3">
            <label for="json_file" class="form-label">Selecione o arquivo JSON:</label>
            <input type="file" name="json_file" id="json_file" accept=".json" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Iniciar Importação</button>
    </form>

    <a href="{{ route('welcome') }}" class="btn btn-secondary">Voltar ao Menu</a>
@endsection
