<?php

namespace App\Repository;

use App\Singleton\Elasticsearch;

class BaseRepository
{
    protected function storeLog(string $query, string $results,string $driver): void
    {
        $client = Elasticsearch::getClient();
        $client->index([
            'index' => 'logs',
            'body' => [
                'query' => $query,
                'driver' => $driver,
                'results' => $results
            ]
        ]);
    }
}
