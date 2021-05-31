<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artigo extends Model
{
    use HasFactory;
    
   
    protected $fillable=[
        'titulo',
        'subtitulo',
        'conteudo',
        'autor',
        'idAutor',
        'curtidas'
    ];
}
