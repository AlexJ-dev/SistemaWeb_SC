<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoriaOcupacional extends Model
{
    protected $table = 'historia_ocupacional';

    protected $fillable = [
        'paciente_id',
        'fecha_inicio',
        'fecha_fin',
        'empresa',
        'actividad_realizada',
        'ubicacion_departamento',
        'altura_snm',
        'area_trabajo',
        'ocupacion',
        'tiempo_subsuelo',
        'tiempo_superficie',
        'exposiciones_peligrosas',
        'medidas_proteccion_ambiental',
        'medidas_proteccion_personal'
    ];

    protected $casts = [
        'exposiciones_peligrosas' => 'array',
        'medidas_proteccion_ambiental' => 'array',
        'medidas_proteccion_personal' => 'array',
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'paciente_id');
    }
}
