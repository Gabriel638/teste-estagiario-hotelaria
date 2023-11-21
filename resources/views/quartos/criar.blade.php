<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Quarto</title>


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="container mt-5">

    <h1 class="mb-4">Criar Quarto:</h1>
    <hr>
    <form action="{{ route('quartos-guardar')}}" method="post">
        @csrf <!-- Token CSRF para proteção contra ataques de falsificação de solicitações entre sites -->

        <!-- Campo 'numero' -->
        <div class="mb-3">
            <label for="numero" class="form-label">Número do Quarto:</label>
            <input type="text" name="numero" id="numero" class="form-control" required>
        </div>

        <!-- Campo 'capacidade' -->
        <div class="mb-3">
            <label for="capacidade" class="form-label">Capacidade:</label>
            <input type="number" name="capacidade" id="capacidade" class="form-control" required>
        </div>

        <!-- Campo 'preco_diaria' -->
        <div class="mb-3">
            <label for="preco_diaria" class="form-label">Preço Diária:</label>
            <input type="number" name="preco_diaria" id="preco_diaria" class="form-control" step="0.01" required>
        </div>

        <!-- Campo 'disponivel' -->
        <div class="mb-3 form-check">
            <input type="checkbox" name="disponivel" id="disponivel" class="form-check-input">
            <label for="disponivel" class="form-check-label">Disponível</label>
        </div>


        <!-- Botão de Envio -->
        <button type="submit" class="btn btn-primary">Criar Quarto</button>
    </form>

</body>
</html>
