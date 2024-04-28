<?php

namespace App\Services;

use GuzzleHttp\Client;

class Jam
{
    protected $apiKey;
    protected $client;

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
        $this->client = new Client(['base_uri' => 'http://api.timezonedb.com/v2.1/']);
    }

    public function getCurrentTime()
    {
        $response = $this->client->request('GET', "get-time-zone?key={$this->apiKey}&format=xml&by=zone&zone=Asia/Jakarta");

        // Ubah respons XML menjadi array
        $data = simplexml_load_string($response->getBody()->getContents(), 'SimpleXMLElement', LIBXML_NOCDATA);
        $data = json_decode(json_encode($data), true);

        // Ambil waktu terformat dari data XML
        $currentTime = $data['formatted'];

        return $currentTime;
    }
}
