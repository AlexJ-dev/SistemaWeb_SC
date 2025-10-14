<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atencion extends Model
{
    use HasFactory;

    // Nombre de la tabla (opcional si sigue la convención plural)
    protected $table = 'atenciones';

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'paciente_id',
        'tipo_evaluacion',
        'registrado_por',
        'registrado_en',
    ];

    // Relación: una atención pertenece a un paciente
    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }
}
