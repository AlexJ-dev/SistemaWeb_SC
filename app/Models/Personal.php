<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\EspecialidadOcupacional;
use App\Models\User;

class Personal extends Model
{
    use HasFactory;

    protected $table = 'personal';

    protected $fillable = [
        'apellido',
        'nombre',
        'sexo',
        'direccion',
        'fecha_nacimiento',
        'edad',
        'cmp',
        'dni',
        'telefono',
        'especialidad_id',
        'rol_id',
    ];
    public function setApellidoAttribute($value)
    {
        $this->attributes['apellido'] = strtoupper($value);
    }

    public function setNombreAttribute($value)
    {
        $this->attributes['nombre'] = strtoupper($value);
    }
    // Relación con usuario
    public function usuario()
    {
        return $this->hasOne(User::class);
    }

    // Relación con especialidad (si aplica)
    public function especialidad()
    {
        return $this->belongsTo(EspecialidadOcupacional::class, 'especialidad_id');
    }
    public function rol()
    {
        return $this->belongsTo(Rol::class);
    }
}
