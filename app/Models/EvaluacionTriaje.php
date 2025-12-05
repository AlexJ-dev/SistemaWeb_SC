<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EvaluacionTriaje extends Model
{
    protected $table = 'evaluacion_triaje';

    protected $fillable = [
        'evaluacion_id',
        'talla',
        'peso',
        'indice_masa_corporal',
        'frecuencia_respiratoria',
        'frecuencia_cardiaca',
        'saturacion_oxigeno',
        'presion_arterial',
        'temperatura',
        'perimetro_toracico',
        'perimetro_abdominal',
        'cintura',
        'cadera',
        'indice_cintura_cadera',
        'anamnesis',
        'ectoscopia',
        'estado_mental',
    ];

    public function evaluacion()
    {
        return $this->belongsTo(Evaluacion::class);
    }
}
