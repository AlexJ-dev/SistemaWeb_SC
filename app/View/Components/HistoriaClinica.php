<?php

namespace App\View\Components;

use Illuminate\View\Component;

class HistoriaClinica extends Component
{
    public $historia;
    public $paciente;
    public $antecedentesMedicos;
    public $antecedentesFamiliares;
    public $enfermedades;

    public function __construct($historia, $paciente, $antecedentesMedicos = null, $antecedentesFamiliares = null, $enfermedades = [])
    {
        $this->historia = $historia;
        $this->paciente = $paciente;
        $this->antecedentesMedicos = $antecedentesMedicos;
        $this->antecedentesFamiliares = $antecedentesFamiliares;
        $this->enfermedades = $enfermedades;
    }

    public function render()
    {
        return view('components.historia-clinica');
    }
}
