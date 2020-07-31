<?php

use App\Components\PokemonComponent;

class PokemonApiTest extends TestCase
{
    public function testGetAll() {
        $response = $this->call('GET', '/api/pokemons');
    
        $response->assertStatus(200)
            ->assertJsonPath('0.name', 'bulbasaur');

        $this->assertArrayHasKey(900,$response);
    }

    public function testGetName() {
        $response = $this->call('GET', '/api/pokemons/pikachu');

        $this->assertEquals(200, $response->status());
    }


    public function testGetByPartialName() {
        $response = $this->call('GET', '/api/pokemons/search/p');

        $response
            ->assertStatus(200)
            ->assertJsonCount(15)
            ->assertJsonMissingValidationErrors();
    }

    public function testGetByPartialNameLimit() {
        $count = 5;
        $response = $this->call('GET', "/api/pokemons/search/p?limit={$count}");

        $response
            ->assertStatus(200)
            ->assertJsonCount($count)
            ->assertJsonMissingValidationErrors();
    }

    public function testGetByPartialNameLimitTopsAt15() {
        $count = 50;
        $response = $this->call('GET', "/api/pokemons/search/p?limit={$count}");

        $response
            ->assertStatus(200)
            ->assertJsonCount(15)
            ->assertJsonMissingValidationErrors();
    }

    public function testGetByPartialNameLimitTopsAtFifteen() {
        $offset = 5;
        $response = $this->call('GET', "/api/pokemons/search/bu?");
        $response2 = $this->call('GET', "/api/pokemons/search/bu?offset={$offset}");

        $response
            ->assertStatus(200)
            ->assertJsonCount(15)
            ->assertJsonMissingValidationErrors();
        $response2
            ->assertStatus(200)
            ->assertJsonCount(15)
            ->assertJsonMissingValidationErrors();

        $this->assertEquals($response[$offset],$response2[0]);

    }

    public function testGetWrongName() {
        $response = $this->call('GET', '/api/pokemons/POKEMONDESCONOCIDO');

        $this->assertEquals(404, $response->status());
    }

    
    
}