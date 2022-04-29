<?php

namespace App\Services;

use Goutte\Client;

class Scrapper
{
    protected $url;
    protected $client;
    protected $headers;

    public function __construct()
    {
        $this->url = 'https://www.dunelondon.pk/collections/mens-new-in/Men-Shoes-New-Arrivals';
        $this->client = new Client();
        $this->headers = [
            'cache-control' => 'no-cache',
            'content-type' => 'application/x-www-form-urlencoded',
        ];
    }

    public function getResponse(string $uri = null)
    {

        $crawler = $this->client->request('GET', 'https://www.dunelondon.pk/collections/mens-new-in/Men-Shoes-New-Arrivals');
        echo "<pre>";
        $crawler->filter('div.grid-product__content > a')->each(function ($node) {
            echo ($node->link()->getUri()) . "<br>";
            print_r($node->selectDiv('grid-product__price')->text());
            echo ($node->text())."<br>";
        });
        $linkCrawler = $crawler->filter('.grid-product__price');
        exit;
        $crawler->filter('a.grid-product__link')->each(function ($node) {
            print_r($node->text())."<br>";
        });
        exit;
        $crawler = $client->click($crawler->selectLink('grid-product__link')->link());
        $form = $crawler->selectButton('Sign in')->form();
        $crawler = $client->submit($form, ['login' => 'fabpot', 'password' => 'xxxxxx']);
        $crawler->filter('.flash-error')->each(function ($node) {
            print $node->text()."\n";
        });

        $response = $request ? $request->getBody()->getContents() : null;
        $status = $request ? $request->getStatusCode() : 500;

        if ($response && $status === 200 && $response !== 'null') {
            return (object) json_decode($response);
        }

        return null;
    }
}