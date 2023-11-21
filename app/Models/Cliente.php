<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    // Define os campos que podem ser preenchidos
    protected $fillable = [
        'nome',
        'email',
        'telefone',
    ];
    public function reservas()
    {
        // Um cliente pode ter várias reservas
        return $this->hasMany(Reserva::class, 'cliente_id', 'id');
    }
}
