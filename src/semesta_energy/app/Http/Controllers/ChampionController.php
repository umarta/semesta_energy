<?php

namespace App\Http\Controllers;

use App\Http\Resources\ResponseListCollection;
use app\Libraries\CustomPagination;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Cache;

class ChampionController extends Controller
{

    public function index(Request $request)
    {
        $limit = $request->limit ?? 10;

        if (!Cache::has('champion_data')) {
            $this->rememberHeroes();
        }
        $response = Cache::get('champion_data');

        if (!Cache::has("champion_data_query_heroes_{$request->heroes}_page_{$request->page}_limit_{$limit}")) {
            Log::info("store cache : champion_data_query_heroes_{$request->heroes}_page_{$request->page}_limit_{$limit}");

            Cache::remember("champion_data_query_heroes_{$request->heroes}_page_{$request->page}_limit_{$limit}", 3600, function () use ($response) {
                return $response;
            });
        }


        if ($request->has('heroes')) {

            $response = collect($response)->filter(function ($filter) use ($request) {
                return stripos($filter['name'], $request->heroes) !== false;
            })->values();


        }
        $collect = $this->paginate($response, $limit);

        $res = [
            'data' => [
                'list' => collect($collect)->values()->flatten(1),
                'pagination' => [
                    'total' => $collect->total(),
                    'last_page' => $collect->lastPage(),
                    'current_page' => $collect->currentPage()
                ]
            ],
            'success' => true,
            'message' => 'Champion list received'
        ];
        return response()->json($res);
    }

    private function rememberHeroes()
    {
        $url = 'https://ddragon.leagueoflegends.com/cdn/6.24.1/data/en_US/champion.json';
        $response = Http::get($url);
        Cache::remember('champion_data', 3600, function () use ($response) {
            return collect($response->json()['data'])->values();
        });
    }


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function paginate($items, $perPage = 5, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items->values() : Collection::make($items)->values();
        return new CustomPagination($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
