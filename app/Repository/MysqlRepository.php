<?php

namespace App\Repository;

use App\Contracts\ISearchable;
use App\Models\People;
use Illuminate\Support\Facades\DB;

class MysqlRepository extends BaseRepository implements ISearchable
{

    public function search(string $name, int $page): array
    {
        DB::enableQueryLog();
        $query = People::query()
            ->select('*')
            ->selectRaw("MATCH(nombre) AGAINST('$name' IN NATURAL LANGUAGE MODE) AS score")
            ->whereRaw("match(nombre) AGAINST('$name' IN NATURAL LANGUAGE MODE)")
            ->orderByDesc('score')
            ->paginate(10,null, null, $page);

        $this->storeLog(DB::getQueryLog()[1]['query'],json_encode($query->items()));

        return $query->items();
    }
}
