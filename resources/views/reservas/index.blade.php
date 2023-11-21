<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Reservas</title>


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="container mt-5">
<!-- Cabeçalho da página -->
    <div class="row">
        <div class="col-md-6 mb-4">
            <h1>Listagem de Reservas</h1>
        </div>
        <div class="col-md-6 mb-4 text-end">
            <!-- Botões de navegação e ação -->
            <a href="{{ route('reservas-criar') }}" class="btn btn-success">Registrar reserva</a>
            <a href="{{ route('reservas-listar') }}" class="btn btn-primary">Todas as Reservas</a>
            <a href="{{ route('quartos-listar') }}" class="btn btn-info">Quartos</a>
            <a href="{{ route('clientes-listar') }}" class="btn btn-primary">Clientes</a>
            <!-- Formulário de logout -->
            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-danger">Sair</button>
            </form>
        </div>
    </div>
<!-- Formulário de pesquisa por data -->
<div class="row mb-12">
    <div class="col-md-8">
        <form action="{{ route('reservas-por-data') }}" method="get">
            @csrf
            <div class="mb-3 d-flex align-items-end">
                <label for="data_inicio" class="form-label me-2">Check-in:</label>
                <input type="date" name="data_inicio" id="data_inicio" class="form-control me-2" >
                <label for="data_fim" class="form-label me-2">Check-out:</label>
                <input type="date" name="data_fim" id="data_fim" class="form-control me-2" >
                <button type="submit" class="btn btn-primary">Pesquisar</button>
            </div>
        </form>
    </div>
</div>
<!-- Formulário de pesquisa por cliente -->
<div class="row mb-12">
    <div class="col-md-8">
        <form action="{{ route('reservas-por-cliente') }}" method="get">
            @csrf
            <div class="mb-3 d-flex align-items-end">
                <label for="cliente_id" class="form-label me-2">Cliente:</label>
                <select name="cliente_id" id="cliente_id" class="form-select me-2">
                    <option value="" selected disabled>Selecione um cliente</option>
                    @foreach($clientes as $cliente)
                        <option value="{{ $cliente->id }}">{{ $cliente->nome }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary">Pesquisar</button>
            </div>
        </form>
    </div>
</div>



<!-- Tabela de Reservas -->
    @if(!is_null($reservas) && count($reservas) > 0)
        <table class="table table-striped table-hover">
            <thead class="bg-primary text-white">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Check-in</th>
                    <th scope="col">Check-out</th>
                    <th scope="col">Id-quarto</th>
                    <th scope="col">Id-cliente</th>
                    <th scope="col">Ação</th>
                </tr>
            </thead>
            <tbody>
                <!-- Loop para exibir as reservas -->
                @foreach($reservas as $reserva)
                    <tr>
                        <th scope="row">{{ $reserva->id }}</th>
                        <td>{{ $reserva->data_checkin }}</td>
                        <td>{{ $reserva->data_checkout }}</td>
                        <td>{{ $reserva->quarto_id }}</td>
                        <td>{{ $reserva->cliente_id }}</td>
                        <th class="d-flex">
                            <!-- Botão para editar uma reserva -->
                        <a href="{{ route('reservas-editar', ['id' => $reserva->id]) }}" class ="btn btn-primary me-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                            </svg>
                        </a>
                        <!-- Formulário para excluir uma reserva -->
                        <form action="{{route('reservas-excluir',['id' => $reserva->id] )}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                                <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                            </svg>
                            </button>
                        </form>
                        </th>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
    <!-- Mensagem para caso não haja reservas -->
        <div class="alert alert-info" role="alert">
            Nenhum reserva disponível no momento.
        </div>
    @endif

</body>
</html>
