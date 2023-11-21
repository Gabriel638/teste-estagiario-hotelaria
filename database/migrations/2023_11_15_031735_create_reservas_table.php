<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         // Criação da tabela 'quartos'
        Schema::create('quartos', function (Blueprint $table) {
            $table->id();
            $table->string('numero');
            $table->integer('capacidade');
            $table->decimal('preco_diaria', 8, 2);
            $table->boolean('disponivel')->default(false);
            $table->timestamps();
            });

         // Criação da tabela 'clientes'
        Schema::create('clientes', function (Blueprint $table) {
                    $table->id();
                    $table->string('nome');
                    $table->string('email')->unique();
                    $table->string('telefone');
                    $table->timestamps();
                    });

         // Criação da tabela 'reservas'
            Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            $table->date('data_checkin');
            $table->date('data_checkout');
            $table->unsignedBigInteger('quarto_id');
            $table->unsignedBigInteger('cliente_id');
            $table->timestamps();

         // Chaves estrangeiras para vincular 'reservas' a 'quartos' e 'clientes'
            $table->foreign('quarto_id')->references('id')->on('quartos')->onDelete('cascade');
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');
            });


        }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Reverte a criação da tabela 'reservas' caso seja necessário desfazer as migrações
        Schema::dropIfExists('reservas');
    }
}
