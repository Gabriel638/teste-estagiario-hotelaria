<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente</title>

    <!-- Adicione os links para o Bootstrap CSS e JS aqui -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Adicione a biblioteca jQuery e jQuery Mask -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
</head>
<body class="container mt-5">

    <h1 class="mb-4">Editar Cliente:</h1>
    <hr>
    <form action="{{ route('clientes-atualizar', ['id' => $clientes->id]) }}" method="post">
        @csrf <!-- Token CSRF para proteção contra ataques de falsificação de solicitações entre sites -->
        @method('PUT')

        <!-- Campo 'nome' -->
        <div class="mb-3">
            <label for="nome" class="form-label">Nome do Cliente:</label>
            <input type="text" name="nome" id="nome" class="form-control" required placeholder="Nome" value="{{ $clientes->nome }}">
        </div>

        <!-- Campo 'e-mail' -->
        <div class="mb-3">
            <label for="email" class="form-label">E-mail:</label>
            <input type="email" name="email" id="email" class="form-control" required placeholder="E-mail" value="{{ $clientes->email }}">
        </div>

        <!-- Campo 'telefone' -->
        <div class="mb-3">
            <label for="telefone" class="form-label">Telefone:</label>
            <input type="tel" name="telefone" id="telefone" class="form-control campo_telefone" placeholder="(99)99999-9999" required value="{{ $clientes->telefone }}">
        </div>

        <!-- Botão de Envio -->
        <button type="submit" class="btn btn-primary">Editar Cliente</button>
    </form>

    <!-- BEGIN PAGE LEVEL JS -->
     <!-- Script para aplicar a máscara de telefone usando a biblioteca jQuery Mask -->
    <script type="text/javascript">
        $(document).ready(function() {
            var SPMaskBehavior = function (val) {
                return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
            };

            var spOptions = {
                onKeyPress: function(val, e, field, options) {
                    field.mask(SPMaskBehavior.apply({}, arguments), options);
                }
            };

            $('.campo_telefone').mask(SPMaskBehavior, spOptions);
        });
    </script>
    <!-- END PAGE LEVEL JS -->
</body>
</html>
