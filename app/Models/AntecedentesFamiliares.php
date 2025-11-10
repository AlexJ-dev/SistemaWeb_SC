<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AntecedentesFamiliares extends Model
{
    protected $table = 'antecedentes_familiares';

    protected $fillable = [
        'historia_clinica_id',
        'numero_hijos_vivos',
        'numero_hijos_muertos',
        'salud_padre',
        'observacion_padre',
        'salud_madre',
        'observacion_madre',
        'salud_esposo',
        'observacion_esposo',
        'salud_hijos',
        'observacion_hijos',
        'numero_dependientes',
        
    ];

    public function historiaClinica()
    {
        return $this->belongsTo(HistoriaClinica::class);
    }
}
