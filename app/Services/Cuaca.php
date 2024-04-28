<?php

namespace App\Services;

use GuzzleHttp\Client;

class Cuaca
{
    protected $apiKey;
    protected $client;

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
        $this->client = new Client(['base_uri' => 'https://weather.visualcrossing.com/VisualCrossingWebServices/rest/services/']);
    }

    public function getWeather($city)
    {
        $response = $this->client->request('GET', 'timeline/' . $city, [
            'query' => [
                'unitGroup' => 'us',
                'key' => $this->apiKey,
                'contentType' => 'json',
            ],
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }
}
