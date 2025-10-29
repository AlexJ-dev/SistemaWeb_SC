<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Atributos que pueden asignarse masivamente.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'password',
        'password_visible',
        'personal_id',
    ];

    /**
     * Atributos ocultos para serialización.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Atributos con casting automático.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relación: el usuario pertenece a un rol institucional.
     */
    public function rol()
    {
        return $this->personal?->rol;
    }


    /**
     * Relación: el usuario está vinculado a un registro de personal.
     */
    public function personal()
    {
        return $this->belongsTo(Personal::class);
    }

    /**
     * Accesor: nombre completo del personal vinculado.
     */
    public function getNombreCompletoAttribute()
    {
        if ($this->personal) {
            return "{$this->personal->apellido} {$this->personal->nombre}";
        }

        return null;
    }
}
