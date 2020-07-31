<?php

namespace App\Http\Controllers;
use App\Components\PokemonComponent;
use Illuminate\Http\Request;


class PokemonController extends Controller
{
    private $pokemonComponent;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(PokemonComponent $pokemonComponent)
    {
        $this->pokemonComponent = $pokemonComponent;
    }

    public function getAll()
    {
        return $this->pokemonComponent->getAll();
    }

    public function getByPartialName(Request $request, $name)
    {
        $limit = $request->get('limit');
        $offset = $request->get('offset');
       
        return $this->pokemonComponent->getByPartialName($name, $limit, $offset);
    }

    public function getByName($name){
            return $this->pokemonComponent->getDataByName($name);
    }
}
