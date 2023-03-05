<?php

namespace App\Factory;

use App\Contracts\ISearchable;
use App\Repository\ElasticsearchRepository;
use App\Repository\MysqlRepository;
use Exception;

class SearchFactory
{
    public static $DRIVER_ELASTICSEARCH = 'elasticsearch';
    public static $DRIVER_MYSQL = 'mysq';

    public static function driver(string $driver): ISearchable
    {
        switch ($driver) {
            case self::$DRIVER_ELASTICSEARCH:
                return new ElasticsearchRepository();
            case self::$DRIVER_MYSQL:
                return new MysqlRepository();
            default:
                throw new Exception('Invalid Driver');
        }
    }
}
