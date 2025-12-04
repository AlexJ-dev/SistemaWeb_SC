<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enfermedad extends Model
{
    use HasFactory;

    protected $table = 'enfermedades';
    protected $fillable = ['nombre'];

    public function antecedentesMedicos()
    {
        return $this->belongsToMany(AntecedentesMedicos::class, 'antecedente_medico_enfermedad');
    }
}
