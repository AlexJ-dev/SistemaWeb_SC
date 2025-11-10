<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    protected $table = 'pacientes';
    protected $fillable = [
        'nombres',
        'apellidos',
        'documento',
        'tipo_documento',
        'fecha_nacimiento',
        'edad',
        'sexo',
        'telefono',
        'correo_electronico',
        'fecha',
        'registrado_en',
    ];

   
    public function fichaOcupacional()
    {
        return $this->hasOne(FichaOcupacional::class);
    }

    public function historiaClinica()
    {
        return $this->hasOne(HistoriaClinica::class);
    }
}
