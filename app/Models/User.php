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
     */
    protected $fillable = [
        'name',
        'password',
        'password_visible',
        'personal_id',
    ];

    /**
     * Atributos ocultos.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casts automáticos.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relación: el usuario pertenece a un registro de personal.
     */
    public function personal()
    {
        return $this->belongsTo(Personal::class);
    }

    /**
     * Relación REAL hacia el rol del usuario.
     *
     * Esta no es una relación de base de datos directa, 
     * pero funciona para acceder al rol desde auth()->user()->rol
     */
    public function getRolAttribute()
    {
        return $this->personal?->rol;
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
