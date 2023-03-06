<?php

namespace App\Services;

use App\Factory\SearchFactory;

class SearchService
{
    public function getPeople(array $params): array
    {
        $defaultSearchDriver = env('DEFAULT_SEARCH_DRIVER', SearchFactory::$DRIVER_MYSQL);
        $repository = SearchFactory::driver($defaultSearchDriver);
        return $repository->search($params['name'], $params['page']);
    }

}
