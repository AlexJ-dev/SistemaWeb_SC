<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AreaOcupacional extends Model
{
    use HasFactory;

    protected $table = 'areas_ocupacionales';
    protected $fillable = ['nombre', 'ubicacion', 'descripcion'];
}
