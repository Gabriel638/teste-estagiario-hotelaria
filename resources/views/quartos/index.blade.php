<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Quartos</title>


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="container mt-5">

    <div class="row">
        <div class="col-md-4 mb-4">
            <h1>Listagem de Quartos</h1>
        </div>
        <div class="col-md-8 mb-4 text-end">
            <!-- Links de navegação -->
            <a href="{{ route('quartos-disponiveis') }}" class="btn btn-primary">Quartos Disponiveis</a>
            <a href="{{ route('quartos-listar') }}" class="btn btn-info">Todos os Quartos</a>
            <a href="{{ route('quartos-criar') }}" class="btn btn-success">Registrar Quarto</a>
            <a href="{{ route('reservas-listar') }}" class="btn btn-info">Reservas</a>
            <a href="{{ route('clientes-listar') }}" class="btn btn-primary">Clientes</a>
            <!-- Formulário de logout -->
            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-danger">Sair</button>
            </form>
        </div>
    </div>
<!-- Verifica se há quartos disponíveis para listar -->
    @if(!is_null($quartos) && count($quartos) > 0)
     <!-- Tabela de listagem de quartos -->
        <table class="table table-striped table-hover">
            <thead class="bg-primary text-white">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Número do Quarto</th>
                    <th scope="col">Capacidade</th>
                    <th scope="col">Preço Diária</th>
                    <th scope="col">Ação</th>
                </tr>
            </thead>
            <tbody>
                 <!-- Loop para exibir cada quarto na tabela -->
                @foreach($quartos as $quarto)
                    <tr>
                        <th scope="row">{{ $quarto->id }}</th>
                        <td>{{ $quarto->numero }}</td>
                        <td>{{ $quarto->capacidade }}</td>
                        <td>R$ {{ $quarto->preco_diaria }}</td>
                        <th class="d-flex">
                            <!-- Botão de edição -->
                        <a href="{{ route('quartos-editar', ['id' => $quarto->id]) }}" class ="btn btn-primary me-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                            </svg>
                        </a>
                        <!-- Formulário de exclusão -->
                        <form action="{{route('quartos-excluir',['id' => $quarto->id] )}}" method="POST">
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
     <!-- Mensagem de alerta quando não há quartos disponíveis -->
        <div class="alert alert-info" role="alert">
            Nenhum quarto disponível no momento.
        </div>
    @endif

</body>
</html>
