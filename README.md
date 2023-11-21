****Teste para Estagiário de Desenvolvimento Web com Laravel, PostgreSQL e Redis - Hotelaria****

Este projeto é parte do teste para a vaga de estagiário de desenvolvimento web com Laravel, PostgreSQL e Redis, com foco em gestão de quartos e reservas em um contexto hoteleiro.

**Requisitos**

Certifique-se de ter os seguintes requisitos instalados antes de prosseguir:

-PHP (versão 7.4 ou superior)

-Composer

-PostgreSQL

-Laravel

-Redis

**Configuração Inicial**

1- Clone este repositório:
git clone https://github.com/Gabriel638/teste-estagiario-hotelaria.git

2- Navegue até o diretório do projeto:
cd teste-estagiario-hotelaria

3- Rodando o Servidor Local:

Abra o terminal ou prompt de comando.

Navegue até o diretório do seu projeto Laravel, usando o comando cd:

Execute o comando para iniciar o servidor Laravel:
php artisan serve

O Laravel iniciará o servidor e informará em qual endereço o aplicativo está sendo executado, geralmente em http://127.0.0.1:8000/

**Requisitos do teste**

Parte 1: Laravel

Rotas e Controladores:

Crie uma rota em Laravel que corresponda a um controlador chamado QuartoController e ao método listarDisponiveis.
O método listarDisponiveis deve retornar uma lista de quartos disponíveis para reserva.
Utilize Eloquent para acessar os dados.
Middleware:

Migrações:

Crie uma migração para uma tabela chamada reservas com campos como data_checkin, data_checkout, quarto_id e cliente_id.
Parte 2: PostgreSQL

Modelo Eloquent:

Crie um modelo Eloquent chamado Reserva para a tabela reservas.
Adicione um método no modelo para recuperar todas as reservas feitas por um cliente específico.
Consulta SQL:

Escreva uma consulta SQL para encontrar todos os quartos que estão ocupados em uma data específica.
Relacionamentos:

Lista reservas de clientes com um campo id, crie um relacionamento no modelo Cliente que retorne todas as reservas associadas a esse cliente.
