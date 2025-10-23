<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RutaMedica extends Model
{
    protected $table = 'ruta_medica';

    protected $fillable = [
        'documento',
        'nombres',
        'apellidos',
        'tipo_documento',
        'empresa',
        'cargo',
        'tipo_evaluacion',
        'registrado_por',
    ];
    protected $casts = [
        'registrado_en' => 'datetime',
    ];

}
