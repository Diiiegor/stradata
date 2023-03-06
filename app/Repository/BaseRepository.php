<?php

namespace App\Repository;

use App\Singleton\Elasticsearch;

class BaseRepository
{
    protected function storeLog(string $query, string $results): void
    {
        $client = Elasticsearch::getClient();
        $client->index([
            'index' => 'logs',
            'body' => [
                'query' => $query,
                'results' => $results
            ]
        ]);
    }
}
