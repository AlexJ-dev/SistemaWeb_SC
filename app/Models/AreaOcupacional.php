<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\Evaluacion;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AreaOcupacional extends Model
{
    use HasFactory;

    protected $table = 'areas_ocupacionales';
    protected $fillable = ['nombre', 'ubicacion', 'descripcion'];

    public function evaluaciones()
{
    return $this->hasMany(Evaluacion::class, 'area_ocupacional_id');
}

}
