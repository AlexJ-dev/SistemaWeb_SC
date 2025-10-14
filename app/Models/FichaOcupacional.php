<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FichaOcupacional extends Model
{
    protected $fillable = [
        'paciente_id',
        'tipo_evaluacion',
        'empresa',
        'contratista',
        'puesto_postula',
        'puesto_actual',
        'tiempo_puesto_actual',
        'explora_superficie',
        'explora_concentradora',
        'explora_subsuelo',
        'altitud',
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }
}
