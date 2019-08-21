<?php

namespace App\Api;
use GuzzleHttp\Client;

class GuzzleController {
    private $client;

    public function __construct() {
        $this->client = new Client(['base_uri' => 'https://api-adresse.data.gouv.fr/search/?q=']);

    }

    public function GuzzleRequest($l) {

        $response = $this->client->get($l);
        $response->getBody();
        return $response;
    }

    public function curlRequest($l) {
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, 'https://api-adresse.data.gouv.fr/search/?q='.$l);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);

        $response = curl_exec($c);
        return $response;
    }
}