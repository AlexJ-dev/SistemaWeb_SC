<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluacion extends Model
{
    use HasFactory;

    protected $table = 'evaluaciones';

    protected $fillable = [
        'ruta_medica_id',
        'area_ocupacional_id',
        'user_id',
        'hora_ingreso',
        'hora_salida',
        'observaciones',
        'estado',
        'no_aplica'
    ];

    public function rutaMedica()
    {
        return $this->belongsTo(RutaMedica::class, 'ruta_medica_id');
    }

    public function areaOcupacional()
    {
        return $this->belongsTo(AreaOcupacional::class, 'area_ocupacional_id');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
