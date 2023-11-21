<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quarto extends Model
{
    use HasFactory;
    // Define os campos que podem ser preenchidos
    protected $fillable = [
        'numero',
        'capacidade',
        'preco_diaria',
        'disponivel',
    ];
}
