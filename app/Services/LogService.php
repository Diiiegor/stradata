<?php

namespace App\Services;

use App\Repository\ElasticsearchRepository;

class LogService
{
    private $repository;

    public function __construct()
    {
        $this->repository = new ElasticsearchRepository();
    }

    public function index($page)
    {
        return $this->repository->listLogs($page);
    }
}
