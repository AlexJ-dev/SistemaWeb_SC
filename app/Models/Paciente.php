<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    protected $fillable = [
        'nombres',
        'apellidos',
        'documento',
        'tipo_documento',
        'fecha_nacimiento',
        'sexo',
        'registrado_en',
    ];

    public function atenciones()
    {
        return $this->hasMany(Atencion::class);
    }
    public function fichaOcupacional()
    {
        return $this->hasOne(FichaOcupacional::class);
    }
}
