<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluacionPsicologia extends Model
{
    use HasFactory;

    protected $table = 'evaluacion_psicologia';

    protected $fillable = [
        'evaluacion_id',
        'presentacion',
        'postura',
        'discurso_ritmo',
        'discurso_tono',
        'discurso_articulacion',
        'orientacion_tiempo',
        'orientacion_espacio',
        'orientacion_persona',
        'nivel_intelectual',
        'coordinacion_visomotriz',
        'nivel_memoria',
        'personalidad',
        'medividad',
        'altura',
        'estres',
        'ansiedad',
        'depresion',
        'fatiga',
        'somnolencia',
        'espacios_confinados',
        'fobias',
        'minisiquiatrico',
        'audit',
        'conclusiones_area_congnitiva',
        'conclusiones_area_emocional',
        'recomendaciones',
    ];

    public function evaluacion()
    {
        return $this->belongsTo(Evaluacion::class);
    }
}

