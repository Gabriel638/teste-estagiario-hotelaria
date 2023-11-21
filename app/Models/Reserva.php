<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    // Define a tabela associada ao modelo
    protected $table = 'reservas';

    // Define os campos que podem ser preenchidos
    protected $fillable = ['cliente_id', 'quarto_id', 'data_checkin', 'data_checkout'];


    public function reservasPorCliente($clienteId)
    {
        // Utiliza o Eloquent para realizar uma consulta e obter as reservas do cliente
        return $this->where('cliente_id', $clienteId)->get();
    }
}
