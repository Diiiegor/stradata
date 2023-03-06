<?php

namespace Database\Seeders;

use App\Models\People;
use App\Singleton\Elasticsearch;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PeopleSeeder extends Seeder
{
    private $client;

    public function __construct()
    {
        $this->client = Elasticsearch::getClient();
    }

    public function run(): void
    {
        $csv = fopen(base_path('storage/app/data/archivoDiccionario.csv'), 'r');
        $row = 1;
        while (($data = fgetcsv($csv, null, ';')) != false) {
            if ($row > 1) {
                $data = [
                    'departamento' => $data[0],
                    'localidad' => $data[1],
                    'municipio' => $data[2],
                    'nombre' => $data[3],
                    'años_activo' => $data[4],
                    'tipo_persona' => $data[5],
                    'tipo_cargo' => $data[6],
                ];
                People::factory()->create($data);
                $this->client->index([
                    'index' => 'names',
                    'body' => $data
                ]);
            }
            $row++;
        }
    }
}
