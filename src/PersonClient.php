<?php

use GuzzleHttp\Client;

class PersonClient
{
    public function fetchPerson() : string
    {
        $personServiceUrl = "http://localhost:7200";
        $endpoint = "/hello";
        $lastName = "Pan";
        $url = sprintf("%s%s/%s", $personServiceUrl, $endpoint, $lastName);

        $client = new Client();
        $response = $client->get($url);

        return (string) $response->getBody();
    }
}
