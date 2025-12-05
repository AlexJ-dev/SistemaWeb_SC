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
        'estado',
        'fecha_salida',
    ];
    protected $casts = [
        'registrado_en' => 'datetime',
        'fecha_salida'  => 'datetime',
    ];
    public function fichaOcupacional()
    {
        return $this->hasOne(FichaOcupacional::class, 'ruta_medica_id');
    }
    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'documento', 'documento');
    }

    public function actualizarEstado()
    {
        $totalEvaluaciones = $this->evaluaciones()->count();
        $evaluacionesCompletadas = $this->evaluaciones()
            ->whereIn('estado', ['completada', 'no_aplica'])
            ->count();

        if ($totalEvaluaciones === 0) {
            $this->estado = 'pendiente';
        } elseif ($totalEvaluaciones === $evaluacionesCompletadas) {
            $this->estado = 'finalizado';
            $this->fecha_salida = now();
        } else {
            $this->estado = 'pendiente';
        }

        $this->save();
    }

    public function evaluaciones()
    {
        return $this->hasMany(Evaluacion::class, 'ruta_medica_id');
    }
}
