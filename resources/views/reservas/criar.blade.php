<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Reserva</title>


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="container mt-5">

    <h1 class="mb-4">Criar Reservas:</h1>
    <hr>
    <form action="{{ route('reservas-guardar')}}" method="post">
        @csrf <!-- Token CSRF para proteção contra ataques de falsificação de solicitações entre sites -->

        <!-- Campo 'data_checkin' -->
        <div class="mb-3">
            <label for="data_checkin" class="form-label">Data de entrada:</label>
            <input type="date" name="data_checkin" id="data_checkin" class="form-control" required>
        </div>

        <!-- Campo 'data_checkout' -->
        <div class="mb-3">
            <label for="data_checkout" class="form-label">Data de saída:</label>
            <input type="date" name="data_checkout" id="data_checkout" class="form-control" required>
        </div>

        <!-- Campo 'quarto' (select) -->
        <div class="mb-3">
            <label for="quarto_id" class="form-label">Quarto:</label>
            <select name="quarto_id" id="quarto_id" class="form-select" required>
                <option value="" disabled selected>Selecione um quarto</option> <!-- Placeholder -->
                <!-- Popula as opções com os quartos disponíveis do banco de dados -->
                @foreach ($quartos as $quarto)
                    <option value="{{ $quarto->id }}">{{ $quarto->numero }}</option>
                @endforeach
            </select>
        </div>

        <!-- Campo 'cliente' (select) -->
        <div class="mb-3">
            <label for="cliente_id" class="form-label">Cliente:</label>
            <select name="cliente_id" id="cliente_id" class="form-select" required>
                <option value="" disabled selected>Selecione um cliente</option> <!-- Placeholder -->
                <!-- Popula as opções com os clientes disponíveis do banco de dados -->
                @foreach ($clientes as $cliente)
                    <option value="{{ $cliente->id }}">{{ $cliente->nome }}</option>
                @endforeach
            </select>
        </div>


        <!-- Botão de Envio -->
        <button type="submit" class="btn btn-primary">Criar Reserva</button>
    </form>

</body>
</html>
