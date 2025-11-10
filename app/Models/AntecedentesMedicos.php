<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AntecedentesMedicos extends Model
{
    protected $table = 'antecedentes_medicos';

    protected $fillable = [
        'historia_clinica_id',
        'patologicos_personales',
        'cirugias',
        'intoxicaciones',
        'alergias',
        'hospitalizaciones',
        'medicamentos',
        'inmunizaciones',
        'observaciones',
        'habito_tabaco',
        'habito_alcohol',
        'habito_drogas',
        'grupo_sanguineo',
    ];

    protected $casts = [
        'cirugias' => 'array',
        'intoxicaciones' => 'array',
        'alergias' => 'array',
        'hospitalizaciones' => 'array',
        'medicamentos' => 'array',
        'inmunizaciones' => 'array',
    ];


    public function historiaClinica()
    {
        return $this->belongsTo(HistoriaClinica::class);
    }
    public function enfermedades()
    {
        return $this->belongsToMany(
            Enfermedad::class,
            'antecedente_medico_enfermedad',
            'antecedente_medico_id', // clave foránea local en la tabla pivote
            'enfermedad_id'           // clave foránea relacionada
        );
    }
}
