<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EvaluacionAdmisionDatos extends Model
{
    protected $table = 'evaluacion_admision_datos';

    protected $fillable = [
        'evaluacion_id',
        'datos_completos',
        'documentos_completos',
    ];

    public function evaluacion()
    {
        return $this->belongsTo(Evaluacion::class);
    }
}

