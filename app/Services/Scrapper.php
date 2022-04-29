<?php

namespace App\Services;

use Goutte\Client;

class Scrapper
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function getResponse(string $uri = null)
    {
        $crawler = $this->client->request('GET', $uri);
        $crawler->filter('head > title');
        return $crawler->text();
    }
}