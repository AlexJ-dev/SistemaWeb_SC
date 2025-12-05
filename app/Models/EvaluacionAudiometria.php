<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluacionAudiometria extends Model
{

    protected $table = 'evaluacion_audiometria';

    protected $fillable = [
        'evaluacion_id',
        'anios_trabajo',
        'tep',
        'uso_tapones',
        'uso_orejeras',
        'apreciacion_ruido',
        'cambio_altitud',
        'exposicion_ruidos',
        'malestar_oido_garganta',
        'problema_dormir',
        'consume_alcohol',
        'uso_medicamentos',
        'consume_tabaco',
        'servicio_militar',
        'hobbi_exposicion_ruido',
        'exposicion_laboral_quimicos', 
        'infecciones_oido',
        'uso_ototoxicos',
        'disminucion_audicion',
        'otalgia',
        'zumbido',
        'mareos',
        'secrecion_oido',
        'otros',
        'otoscopia_oido_der',
        'otoscopia_oido_izq',
        'fre_oido_der_500',
        'fre_oido_der_1000',
        'fre_oido_der_2000',
        'fre_oido_der_3000',
        'fre_oido_der_4000',
        'fre_oido_der_6000',
        'fre_oido_der_8000',
        'fre_oido_izq_500',
        'fre_oido_izq_1000',
        'fre_oido_izq_2000',
        'fre_oido_izq_3000',
        'fre_oido_izq_4000',
        'fre_oido_izq_6000',
        'fre_oido_izq_8000',
        'practica_tiro',
        'usa_auriculares',
        'sordera_familiar',
        'perdida_audio_der',
        'perdida_audio_izq',
    ];


    public function evaluacion()
    {
        return $this->belongsTo(Evaluacion::class);
    }
}
