<?php

namespace App\Singleton;

use Elasticsearch\ClientBuilder;

class Elasticsearch
{
    private static $client = null;

    public static function getClient()
    {
        if (self::$client == null) {
            $host = env('ELASTICSEARCH_HOST');
            self::$client = ClientBuilder::create()->setHosts([$host])->build();
        }
        return self::$client;
    }
}
