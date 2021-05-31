<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class curtidas extends Model
{
    use HasFactory;

    protected $fillable=[
      'idArtigo',
      'idCurtiu'
    ];
}
