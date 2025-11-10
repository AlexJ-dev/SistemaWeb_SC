<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HistoriaClinica extends Model
{
    use HasFactory;

    protected $table = 'historias_clinicas';

    protected $fillable = [
        'paciente_id',
        'numero_historia',
        'lugar_nacimiento_pais',
        'lugar_nacimiento_departamento',
        'lugar_nacimiento_provincia',
        'lugar_nacimiento_distrito',
        'domicilio_direccion',
        'domicilio_departamento',
        'domicilio_provincia',
        'domicilio_distrito',
        'estado_civil',
        'grado_institucional',
        'ocupacion',
        'religion',
        'seguro',
        'licencia_conducir',
        'emergencia_persona',
        'emergencia_direccion',
        'emergencia_parentesco',
        'emergencia_telefono',
        'creado_por',
        'creado_en',
    ];

    // Relación con paciente
    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }

    // Relación con antecedentes familiares
    public function antecedentesFamiliares()
    {
        return $this->hasOne(AntecedentesFamiliares::class);
    }

    // Relación con antecedentes médicos
    public function antecedentesMedicos()
    {
        return $this->hasOne(AntecedentesMedicos::class);
    }
}
