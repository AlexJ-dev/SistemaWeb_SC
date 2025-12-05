<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluacionOftalmologia extends Model
{
    use HasFactory;

    protected $table = 'evaluacion_oftalmologia';

    protected $fillable = [
        'evaluacion_id',
        'hta',
        'diabetes_mellitus',
        'glaucoma',
        'estrabismo',
        'conjuntivitis',
        'traumatismo',
        'radiaciones',
        'quimicos',
        'exposicion_computadoras',
        'prurito',
        'vision_borrosa',
        'cefalea',
        'otros',
        'lentes',
        'parpados_anexos',
        'polo_anterior',
        'reflejo_pupilar',
        'test_ishihara',
        'vision_nocturna',
        'vision_colores',
        'vision_profundidad',
        'av_lejos_sin_corrector_izq',
        'av_lejos_con_corrector_izq',
        'av_cerca_sin_corrector_izq',
        'av_cerca_con_corrector_izq',
        'av_lejos_sin_corrector_der',
        'av_lejos_con_corrector_der',
        'av_cerca_sin_corrector_der',
        'av_cerca_con_corrector_der',
        'sensibilidad_mucosa',
        'diagnostico',
        'recomendaciones',
    ];

    // Relación con Evaluacion   
    public function evaluacion()
    {
        return $this->belongsTo(Evaluacion::class);
    }
}
