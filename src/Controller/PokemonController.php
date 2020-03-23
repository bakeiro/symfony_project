<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\HttpClient;

/**
 * Controller for getting the information of a specific pokemon if exists
 */
class PokemonController extends AbstractController
{
    /**
     * Outputs the welcome page
     */
    public function index()
    {
        $pokemon_data = array("name" => "Pokemon info", "description" => "");
        $data = array('controller_name' => 'PokemonController', "pokemon" => $pokemon_data);

        return $this->render('pokemon/pokemon_index.html.twig', $data);
    }

    /**
     * Search in the pokemon API the pokemon name given in the function parameter
     */
    public function getPokemonData($pokemon_name)
    {
        $url_pokemon_api = "https://pokeapi.co/api/v2/pokemon/".$pokemon_name;
        
        $client = HttpClient::create();
        $response = $client->request('GET', $url_pokemon_api);

        $status_code = $response->getStatusCode();
        $output = array("pokemon_information" => array());

        if ($status_code === 200) {
            $content = $response->getContent();
            $content = $response->toArray();
            $output = array("pokemon_information" => $content);
        }

        return $output;
    }

    /**
     * Returns the pokemon info
     */
    public function pokemonEndpoint($name)
    {
        $output = $this->getPokemonData($name);
        return $this->json($output);
    }
}
