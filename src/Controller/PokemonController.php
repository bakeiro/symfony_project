<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
// use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpClient\HttpClient;

class PokemonController extends AbstractController
{
    public function index()
    {
        $pokemon_data = array("name" => "Pokemon info", "description" => "");
        $data = array('controller_name' => 'PokemonController', "pokemon" => $pokemon_data);

        return $this->render('pokemon/pokemon_index.html.twig', $data);
    }

    public function pokemonEndpoint($name)
    {
        $url_pokemon_api = "https://pokeapi.co/api/v2/pokemon/".$name;
        
        $client = HttpClient::create();
        $response = $client->request('GET', $url_pokemon_api);

        $status_code = $response->getStatusCode();
        $output = array("pokemon_information" => array());

        if ($status_code === 200) {
            $content = $response->getContent();
            $content = $response->toArray();
            $output = array("pokemon_information" => $content);
        }

        return $this->json($output);
    }
}
