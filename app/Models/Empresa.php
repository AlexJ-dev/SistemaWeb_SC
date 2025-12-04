<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;
    protected $table = 'empresas';

    protected $fillable = [
        'nombre',
        'nombre_abreviado',
        'ruc',
        'rubro',
        'direccion',
        'telefono',
        'email',
        'persona_contacto',
        'telefono_contacto',
        'email_contacto',
        'departamento',
        'provincia',
        'distrito',
    ];
}
