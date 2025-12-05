<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FichaOcupacional extends Model
{
    protected $table = 'fichas_ocupacionales';
    protected $fillable = [
        'numero_ficha',
        'paciente_id',
        'historia_clinica_id',
        'ruta_medica_id',
        'tipo_evaluacion',
        'empresa',
        'contratista',
        'puesto_postula',
        'puesto_actual',
        'tiempo_puesto_actual',
        'exploracion_procesados',
        'altitud',
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }

    public function historiaClinica()
    {
        return $this->belongsTo(HistoriaClinica::class);
    }

    public function rutaMedica()
    {
        return $this->belongsTo(RutaMedica::class, 'ruta_medica_id');
    }
    // Relación con Paciente
    /*
    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }

    // Relación con Historia Clínica
    public function historiaClinica()
    {
        return $this->belongsTo(HistoriaClinica::class);
    }
        */

    //Relación con Historia Ocupacional (a través de paciente)
    public function historiaOcupacional()
    {
        return $this->hasOne(HistoriaOcupacional::class, 'paciente_id', 'paciente_id');
    }



    // Relación con Evaluaciones (a través de ruta médica)
    public function evaluaciones()
    {
        return $this->hasMany(Evaluacion::class, 'ruta_medica_id', 'ruta_medica_id');
    }
}
