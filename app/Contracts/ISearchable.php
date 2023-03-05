<?php

namespace App\Contracts;

interface ISearchable
{
    public function search(string $name, int $page):array;
}
