<?php 

namespace App\Components;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use App\Exceptions\NotFoundException;

class PokemonComponent
{
    public function getAll(){
        $pokemonList = Cache::get('pokemonList');
        if($pokemonList == null) {
            $response = Http::get( config('app.poke_api_url') . 'pokemon?limit=1000');
            if($response->ok() && count($pokemonList = $response->json()['results']) >= 1) {
                Cache::put('pokemonList', $pokemonList, config('app.cache_timeout'));
            }
        }
        return $pokemonList;
    }

    public function getByPartialName($name, $limit = 1000, $offset = 0) {
        $pokemonList = array_filter($this->getAll(), function($item) use ($name)  {
            return stripos($item['name'], $name) !== false;
        });
        return array_slice(array_values($pokemonList), $offset, $limit);
    }

    public function getDataByName($name) { 
        $cacheKey = "pokemon-{$name}";
        $pokemon = Cache::get($cacheKey);
        if($pokemon == null) {
            $url = $this->getByExactName($name);
            $response = Http::get($url);
            if($response->ok()){
                Cache::put($cacheKey,$pokemon = $response->json(), config('app.cache_timeout'));
            }
        }
        return $pokemon;
    }

    public function getByExactName($name) {
        $pokemon = current(array_filter($this->getAll(), function($item) use ($name) {
            return strtolower($item['name']) === strtolower($name);
        }));
        if($pokemon == null){
            abort(404);
        }
        return $pokemon['url'];
    }

}