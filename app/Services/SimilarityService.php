<?php

namespace App\Services;

use stdClass;

class SimilarityService
{
    public function filter(array $data, int $similarityPercentage, string $searchName): array
    {
        $results = [];
        foreach ($data as $item) {
            similar_text($item->nombre, $searchName, $percentage);
            if ($percentage >= $similarityPercentage) {
                $itemDto = new stdClass();
                $itemDto->nombre = $item->nombre;
                $itemDto->tipo_persona = $item->tipo_persona;
                $itemDto->tipo_cargo = $item->tipo_cargo;
                $itemDto->departamento = $item->departamento;
                $itemDto->municipio = $item->municipio;
                $itemDto->coincidencia = round($percentage,2);
                $results[] = $itemDto;
            }
        }
        return $results;
    }
}
