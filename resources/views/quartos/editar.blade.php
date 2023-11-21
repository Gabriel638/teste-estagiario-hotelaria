<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Quarto</title>


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="container mt-5">

    <h1 class="mb-4">Editar Quarto:</h1>
    <hr>
    <form action="{{ route('quartos-atualizar', ['id'=>$quartos -> id])}}" method="post">
        @csrf <!-- Token CSRF para proteção contra ataques de falsificação de solicitações entre sites -->
        @method('PUT')
        <!-- Campo 'numero' -->
        <div class="mb-3">
            <label for="numero" class="form-label">Número do Quarto:</label>
            <input type="text" name="numero" class="form-control" value="{{$quartos -> numero}}" required>
        </div>

        <!-- Campo 'capacidade' -->
        <div class="mb-3">
            <label for="capacidade" class="form-label">Capacidade:</label>
            <input type="number" name="capacidade" value="{{$quartos -> capacidade}}" class="form-control" required>
        </div>

        <!-- Campo 'preco_diaria' -->
        <div class="mb-3">
            <label for="preco_diaria" class="form-label">Preço Diária:</label>
            <input type="number" name="preco_diaria" value="{{$quartos -> preco_diaria }}" class="form-control" step="0.01" required>
        </div>

        <!-- Campo 'disponivel' -->
        <div class="mb-3 form-check">
            <input type="checkbox" name="disponivel" id="disponivel" class="form-check-input" {{ $quartos->disponivel ? 'checked' : '' }}>
            <label for="disponivel" class="form-check-label">Disponível</label>
        </div>



        <!-- Botão de Envio -->
        <button type="submit" class="btn btn-primary">Editar Quarto</button>
    </form>

</body>
</html>
