<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Página Inicial</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    </head>
    <body class="d-flex justify-content-center align-items-center vh-100 bg-light">
        <div class="menu text-center">
            <h1 class="mb-4">Menu Principal</h1>
            <a href="{{ route('documents.import.page') }}" class="btn btn-primary mb-3">Importar Documentos</a>
            <br>
            <a href="{{ route('documents.index') }}" class="btn btn-secondary">Visualizar Documentos Importados</a>
        </div>
    </body>
</html>
