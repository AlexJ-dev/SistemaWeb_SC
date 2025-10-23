<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MantenimientoController extends Controller
{
    public function index()
    {
        return view('ocupacional.mantenimiento');
    }
}
