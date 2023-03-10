<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use App\Services\SearchService;
use App\Services\SimilarityService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    private SearchService $searchService;
    private SimilarityService $similarityService;

    public function __construct(SearchService $searchService, SimilarityService $similarityService)
    {
        $this->searchService = $searchService;
        $this->similarityService = $similarityService;
    }

    public function search(SearchRequest $request): JsonResponse
    {
        $people = $this->searchService->getPeople($request->all());
        $filteredPeople = $this->similarityService->filter($people, $request->percentage, $request->name);
        return $this->successResponse($filteredPeople);
    }
}
