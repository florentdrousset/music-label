<?php


namespace App\Api;


class WikiController
{
    public function curlRequest($q) {
        $s = 'http://en.wikipedia.org/w/api.php?action=query&list=search&srsearch=';
        $query = $q;
        $s2 = 'format=jsonfm';
        $query = $s . $query . $s2;
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $query);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);

        $response = curl_exec($c);
        return $response;
    }
}