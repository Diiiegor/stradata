<?php

namespace App\Repository;

use App\Contracts\ISearchable;
use Elasticsearch\ClientBuilder;

class ElasticsearchRepository implements ISearchable
{
    private $client;

    public function __construct()
    {
        $host = env('ELASTICSEARCH_HOST');
        $this->client = ClientBuilder::create()->setHosts(["elasticsearch:9200"])->build();
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

        return array_map(fn($item) => (object)$item['_source'], $results['hits']['hits']);
    }
}
