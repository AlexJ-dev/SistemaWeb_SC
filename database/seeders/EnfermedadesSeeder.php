<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Enfermedad;

class EnfermedadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $enfermedades = [
            'Alergias', 'Asma', 'ACV', 'Bronquitis', 'Convulsiones', 'Diabetes',
            'ETS', 'Hepatitis B', 'HTA', 'Infarto', 'Intoxicaciones', 'ITS',
            'Litiasis', 'Lumbalgia', 'Neoplasias', 'Quemaduras', 'Tifoidea',
            'Tr. Sanguínea', 'Tuberculosis', 'Úlcera gástrica', 'Várices'
        ];

        foreach ($enfermedades as $nombre) {
            Enfermedad::firstOrCreate(['nombre' => $nombre]);
        }
    }
}
