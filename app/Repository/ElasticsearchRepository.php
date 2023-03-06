<?php

namespace App\Repository;

use App\Contracts\ISearchable;
use App\Singleton\Elasticsearch;

class ElasticsearchRepository extends BaseRepository implements ISearchable
{
    private $client;

    public function __construct()
    {
        $this->client = Elasticsearch::getClient();
    }

    public function search(string $name, int $page): array
    {

        $perPage = 10;
        $offset = ($page - 1) * $perPage;
        $query = [
            'index' => 'names',
            'body' => [
                'size' => $perPage,
                'from' => $offset,
                'sort' => [
                    '_score' => [
                        'order' => 'desc'
                    ]
                ],
                'query' => [
                    'match' => [
                        'nombre' => [
                            'query' => $name,
                            'fuzziness' => 'auto'
                        ]
                    ]
                ]
            ]
        ];
        $results = $this->client->search($query);
        $this->storeLog(json_encode($query), json_encode($results['hits']['hits']), 'elasticsearch');
        return array_map(fn($item) => (object)$item['_source'], $results['hits']['hits']);
    }

    public function listLogs($page)
    {
        $perPage = 10;
        $offset = ($page - 1) * $perPage;
        $query = [
            'index' => 'logs',
            'body' => [
                'size' => $perPage,
                'from' => $offset,
            ]
        ];
        $results = $this->client->search($query);
        return array_map(fn($item) => (object)$item['_source'], $results['hits']['hits']);
    }
}
