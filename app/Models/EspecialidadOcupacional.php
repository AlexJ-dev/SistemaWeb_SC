<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EspecialidadOcupacional extends Model
{
    protected $table = 'especialidades_ocupacionales';
    protected $fillable = ['nombre', 'descripcion'];
}
