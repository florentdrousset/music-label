<?php


namespace App\Api;


class WikiController
{
    public function curlRequest($q) {
        $s = 'https://fr.wikipedia.org/w/api.php?action=opensearch&search=';
        $query = $q;
        $query = str_replace(' ', '%20', $query);
        $s2 = '&format=json';
        $query1 = $s . $query . $s2;
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $query1);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);

        $response = curl_exec($c);
        return $response;
    }
}