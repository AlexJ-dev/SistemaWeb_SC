<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluacionRadiografia extends Model
{
    use HasFactory;

    protected $table = 'evaluacion_radiografia';

    protected $fillable = [
        'evaluacion_id',
        'campos_pulmonares',
        'senos',
        'silueta_cardiovascular',
        'vertices',
        'hilo',
        'mediastinos',
        'numero_rayosx',
        'calidad',
        'fecha',
        'simbolos',
        'evaluacion_radiologica',
        'incidencias_frontales_laterales',
        'conclusiones',
    ];

    protected $casts = [
        'campos_pulmonares' => 'array',
        'senos' => 'array',
        'silueta_cardiovascular' => 'array',
        'incidencias_frontales_laterales' => 'array',
        'conclusiones' => 'array',
    ];

    public function evaluacion()
    {
        return $this->belongsTo(Evaluacion::class);
    }
}
