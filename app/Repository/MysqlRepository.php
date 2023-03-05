<?php

namespace App\Repository;

use App\Contracts\ISearchable;
use App\Models\People;

class MysqlRepository implements ISearchable
{

    public function search(string $name, int $page): array
    {
        $query = People::query()->whereRaw("match(nombre) AGAINST('$name' IN NATURAL LANGUAGE MODE)")
            ->paginate(10, ['*'], null, $page);
        return $query->items();
    }
}
