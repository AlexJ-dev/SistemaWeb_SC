<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EspecialidadOcupacional;
use App\Models\User;
use App\Models\Rol;

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

    /**
     * Mutadores para convertir nombre y apellido en mayúsculas
     */
    public function setApellidoAttribute($value)
    {
        $this->attributes['apellido'] = strtoupper($value);
    }

    public function setNombreAttribute($value)
    {
        $this->attributes['nombre'] = strtoupper($value);
    }

    /**
     * Relación: un personal tiene un usuario.
     */
    public function usuario()
    {
        return $this->hasOne(User::class);
    }

    /**
     * Relación con especialidad ocupacional.
     */
    public function especialidad()
    {
        return $this->belongsTo(EspecialidadOcupacional::class, 'especialidad_id');
    }

    /**
     * Relación directa hacia Rol.
     */
    public function rol()
    {
        return $this->belongsTo(Rol::class, 'rol_id');
    }
}
