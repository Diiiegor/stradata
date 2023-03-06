<?php

namespace App\Repository;

use App\Contracts\ISearchable;
use App\Models\People;

class MysqlRepository implements ISearchable
{

    public function search(string $name, int $page): array
    {
        $query = People::query()
            ->select('*')
            ->selectRaw("MATCH(nombre) AGAINST('$name' IN NATURAL LANGUAGE MODE) AS score")
            ->whereRaw("match(nombre) AGAINST('$name' IN NATURAL LANGUAGE MODE)")
            ->orderByDesc('score')
            ->paginate(10,null, null, $page);
        return $query->items();
    }
}
