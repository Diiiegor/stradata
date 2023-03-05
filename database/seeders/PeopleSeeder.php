<?php

namespace Database\Seeders;

use App\Models\People;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PeopleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csv = fopen(base_path('storage/app/data/archivoDiccionario.csv'), 'r');
        $row = 1;
        while (($data = fgetcsv($csv, null, ';')) != false) {
            if ($row > 1) {
                People::factory()->create([
                    'departamento' => $data[0],
                    'localidad' => $data[1],
                    'municipio' => $data[2],
                    'nombre' => $data[3],
                    'años_activo' => $data[4],
                    'tipo_persona' => $data[5],
                    'tipo_cargo' => $data[6],
                ]);
            }
            $row++;
        }
    }
}
