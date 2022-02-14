<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;


class TmdbApi
{

    private $params;
    private $client;
    private $apiKey;
    private $authV4;
    private $pathImg;


    public function __construct(HttpClientInterface $client, ContainerBagInterface $params)
    {

        $this->params = $params;
        $this->client = $client;
        $this->apiKey = $this->params->get('app.TMDB_API_KEY');
        $this->authV4 = $this->params->get('app.TMDB_AUTH_V4');
        $this->headers = 
        [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->authV4,        
                'Content-Type' => 'application/json;charset=utf-8'
            ]
        ];
        // return $this;
    }


    // public function fetchGitHubInformation(): Array
    // {
    //     $response = $this->client->request(
    //         'GET',
    //         'https://api.github.com/repos/symfony/symfony-docs'
    //     );

    //     $statusCode = $response->getStatusCode();
    //     // $statusCode = 200
    //     $contentType = $response->getHeaders()['content-type'][0];
    //     // $contentType = 'application/json'
    //     $content = $response->getContent();
    //     // $content = '{"id":521583, "name":"symfony-docs", ...}'
    //     $content = $response->toArray();
    //     // $content = ['id' => 521583, 'name' => 'symfony-docs', ...]

    //     return $content;
    // }


    private function authenticate(): string
    {

        $messages = [
            'You did it! You updated the system! Amazing!',
            'That was one of the coolest updates I\'ve seen all day!',
            'Great work! Keep going!',
        ];

        $index = array_rand($messages);

        return $messages[$index];
    }

    public function getLatest(): Array
    {
        $url = "https://api.themoviedb.org/3/movie/latest?api_key=" . $this->apiKey . "&language=en-US";
        $response = $this->client->request('GET', $url, $this->headers);
        $content = $response->toArray();

        return $content;
    }

    public function getTrends(): Array
    {
        $url = "https://api.themoviedb.org/3/trending/movie/day?api_key=" . $this->apiKey;
        $response = $this->client->request('GET', $url, $this->headers);
        $content = $response->toArray();
        // var_dump($content);

        return $content;
    }

    public function getDetails($id): Array
    {
        $url = "https://api.themoviedb.org/3/movie/" . $id . "?api_key=" . $this->apiKey . "=en-US";
        $response = $this->client->request('GET', $url, $this->headers);
        $content = $response->toArray();
        // var_dump($content);

        return $content;
    }

    public function getTrendsTv(): Array
    {
        $url = "https://api.themoviedb.org/3/trending/tv/day?api_key=" . $this->apiKey;
        $response = $this->client->request('GET', $url, $this->headers);
        $content = $response->toArray();
        // var_dump($content);

        return $content;

    }
}