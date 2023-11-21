<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Reserva</title>


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="container mt-5">
    <!-- Título da página -->
    <h1 class="mb-4">Editar Reserva:</h1>
    <hr>
    <!-- Formulário de edição de reserva -->
    <form action="{{ route('reservas-atualizar', ['id' => $reservas->id]) }}" method="post">
        @csrf <!-- Token CSRF para proteção contra ataques de falsificação de solicitações entre sites -->
        @method('PUT')
        <!-- Campo 'data_checkin' -->
        <div class="mb-3">
            <label for="data_checkin" class="form-label">Data de entrada:</label>
            <input type="date" name="data_checkin" id="data_checkin" class="form-control" value="{{ $reservas->data_checkin }}" required>
        </div>

        <!-- Campo 'data_checkout' -->
        <div class="mb-3">
            <label for="data_checkout" class="form-label">Data de saída:</label>
            <input type="date" name="data_checkout" id="data_checkout" class="form-control" value="{{ $reservas->data_checkout }}" required>
        </div>

        <!-- Campo 'quarto_id' (select) -->
        <div class="mb-3">
            <label for="quarto_id" class="form-label">Quarto:</label>
            <select name="quarto_id" id="quarto_id" class="form-select" required>

                <option value="{{ $quartoSelecionadoId }}" selected>{{ $quartoSelecionado->numero }}</option>

                <!-- Popula as opções com os quartos disponíveis do banco de dados -->
                @foreach ($quartos as $quarto)
                    @if($quarto->id != $quartoSelecionadoId)
                        <option value="{{ $quarto->id }}">{{ $quarto->numero }}</option>
                    @endif
                @endforeach
            </select>
        </div>



        <!-- Campo 'cliente_id' (select) -->
        <div class="mb-3">
            <label for="cliente_id" class="form-label">Cliente:</label>
            <select name="cliente_id" id="cliente_id" class="form-select" required>
                <!-- Popula as opções com os clientes disponíveis do banco de dados -->
                @foreach ($clientes as $cliente)
                    <option value="{{ $cliente->id }}" @if($cliente->id == $reservas->cliente_id) selected @endif>{{ $cliente->nome }}</option>
                @endforeach
            </select>
        </div>

        <!-- Botão de Envio -->
        <button type="submit" class="btn btn-primary">Editar Reserva</button>
    </form>

</body>
</html>
