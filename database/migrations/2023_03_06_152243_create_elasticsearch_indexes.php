<?php

use App\Singleton\Elasticsearch;
use Illuminate\Database\Migrations\Migration;


return new class extends Migration {
    private $client;

    public function __construct()
    {
        $this->client = Elasticsearch::getClient();
    }

    public function up(): void
    {
        $this->client->indices()->create([
            'index' => 'names',
            'body' => [
                'mappings' => [
                    'properties' => [
                        'años_activo' => [
                            'type' => 'long'
                        ],
                        'departamento' => [
                            'type' => 'keyword'
                        ],
                        'localidad' => [
                            'type' => 'keyword'
                        ],
                        'municipio' => [
                            'type' => 'keyword'
                        ],
                        'nombre' => [
                            'type' => 'text'
                        ],
                        'tipo_cargo' => [
                            'type' => 'keyword'
                        ],
                        'tipo_persona' => [
                            'type' => 'keyword'
                        ],
                    ]
                ]
            ]
        ]);

        $this->client->indices()->create([
            'index' => 'logs',
            'body' => [
                'mappings' => [
                    'properties' => [
                        'query' => [
                            'type' => 'text'
                        ],
                        'driver' => [
                            'type' => 'keyword'
                        ],
                        'results' => [
                            'type' => 'text'
                        ],
                    ]
                ]
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $this->client->indices()->delete(['index'=>'names']);
        $this->client->indices()->delete(['index'=>'logs']);

    }
};
