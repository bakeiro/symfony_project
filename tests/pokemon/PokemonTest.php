<?php

namespace App\Tests\Pokemon;

use App\Controller\PokemonController;
use PHPUnit\Framework\TestCase;

class PokemonTest extends TestCase
{
    /**
     * Test the pokemon end point
     */
    public function testPokemonEndPoint()
    {
        $pokemon_controller = new PokemonController();

        // ditto
        $pokemon_info = $pokemon_controller->getPokemonData("ditto");
        $this->assertEquals(132, $pokemon_info["pokemon_information"]["id"]);
        $this->assertEquals(3, $pokemon_info["pokemon_information"]["height"]);
        $this->assertEquals(197, $pokemon_info["pokemon_information"]["order"]);
        $this->assertEquals("ditto", $pokemon_info["pokemon_information"]["name"]);

        // charmander
        $pokemon_info = $pokemon_controller->getPokemonData("charmander");
        $this->assertEquals(4, $pokemon_info["pokemon_information"]["id"]);
        $this->assertEquals(6, $pokemon_info["pokemon_information"]["height"]);
        $this->assertEquals(5, $pokemon_info["pokemon_information"]["order"]);
        $this->assertEquals("charmander", $pokemon_info["pokemon_information"]["name"]);

        // dittto
        $pokemon_info = $pokemon_controller->getPokemonData("dittto");
        $this->assertEquals(array(), $pokemon_info["pokemon_information"]);
    }
}
