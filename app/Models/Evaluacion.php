<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluacion extends Model
{
    use HasFactory;

    protected $table = 'evaluaciones';

    protected $fillable = [
        'ruta_medica_id',
        'area_ocupacional_id',
        'user_id',
        'hora_ingreso',
        'hora_salida',
        'observaciones',
        'estado',
        'no_aplica'
    ];

    public function rutaMedica()
    {
        return $this->belongsTo(RutaMedica::class, 'ruta_medica_id');
    }

    public function areaOcupacional()
    {
        return $this->belongsTo(AreaOcupacional::class, 'area_ocupacional_id');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function fichaOcupacional()
    {
        return $this->hasOne(FichaOcupacional::class, 'ruta_medica_id', 'ruta_medica_id');
    }

    public function historiaClinica()
    {
        return $this->hasOneThrough(
            HistoriaClinica::class,     // Modelo destino
            FichaOcupacional::class,    // Modelo intermedio
            'ruta_medica_id',           // FK en ficha_ocupacional que apunta a ruta_medica
            'id',                       // PK en historia_clinica
            'ruta_medica_id',           // FK en evaluacion que apunta a ruta_medica
            'historia_clinica_id'       // FK en ficha_ocupacional que apunta a historia_clinica
        );
    }




    //Evaluaciones
    public function admision()
    {
        return $this->hasOne(EvaluacionAdmisionDatos::class);
    }
    public function triaje()
    {
        return $this->hasOne(EvaluacionTriaje::class, 'evaluacion_id');
    }
    public function oftalmologia()
    {
        return $this->hasOne(EvaluacionOftalmologia::class, 'evaluacion_id');
    }
    public function audiometria()
    {
        return $this->hasOne(EvaluacionAudiometria::class, 'evaluacion_id');
    }
    public function espirometria()
    {
        return $this->hasOne(EvaluacionEspirometria::class, 'evaluacion_id');
    }
    public function psicologia()
    {
        return $this->hasOne(EvaluacionPsicologia::class);
    }
    public function radiografia()
    {
        return $this->hasOne(EvaluacionRadiografia::class, 'evaluacion_id');
    }
}
