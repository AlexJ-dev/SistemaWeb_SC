<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluacionEspirometria extends Model
{
    use HasFactory;

    protected $table = 'evaluacion_espirometria';

    protected $fillable = [
        'evaluacion_id',
        'deprendimiento_retina',
        'infarto_corazon',
        'hopitalizado_problema_corazon',
        'medicamentos_tuberculosis',
        'embarazo_actual',
        'diagnostico_covid',
        'hemoptisis',
        'pneumotrorax',
        'traqueostomia',
        'sonda_pleurral',
        'aneurisma_celebral_abdomen_torax',
        'embolia_pulmonar',
        'infarto_reciente',
        'inestabilidad_cv',
        'fiebre_nauseas_vomitos',
        'embarazo_avanzado',
        'embarazo_complicado',
        'amenaza_aborto',
        'infeccion_respiratoria',
        'infeccion_oido',
        'nebulizadores_broncodilatadores',
        'medicamento_broncodilatador',
        'fumo_cigarrillos',
        'cuantos_cigarrillos',
        'ejercicio_fisico',
        'comio',
        'especificaciones',
        'fvc_pre',
        'fvc_ref_porcentaje',
        'fvc_ref',
        'fev1_pre',
        'fev1_ref_porcentaje',
        'fev1_ref',
        'fev_fvc_pre',
        'fev_fvc_ref_porcentaje',
        'fev_fvc_ref',
        'fef_pre',
        'fef_ref_porcentaje',
        'fef_ref',
    ];

    public function evaluacion()
    {
        return $this->belongsTo(Evaluacion::class);
    }
}

