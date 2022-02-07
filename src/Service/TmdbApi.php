<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;


class TmdbApi
{

    private $client;
    private $apiKey;
    private $authV4;
    private $pathImg;


    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
        // @todo : Add apikey & authV4 in config
        $this->apiKey = "2ce2eade1f564ac11d6aa762b7af299a";
        $this->authV4 = "eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiIyY2UyZWFkZTFmNTY0YWMxMWQ2YWE3NjJiN2FmMjk5YSIsInN1YiI6IjYyMDAyZDhjYTg4NTg3MDEwZDI1MjcxNyIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.6f-R0_fPO97I8B8cLmfY7-Rd0zG_MVlFKuOePBfn1MQ";
        $this->pathImg = "https://www.themoviedb.org/t/p/w220_and_h330_face/";
        $this->headers = 
        [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->authV4,        
                'Content-Type' => 'application/json;charset=utf-8'
            ]
        ];
        // return $this;
    }


    public function fetchGitHubInformation(): Array
    {
        $response = $this->client->request(
            'GET',
            'https://api.github.com/repos/symfony/symfony-docs'
        );

        $statusCode = $response->getStatusCode();
        // $statusCode = 200
        $contentType = $response->getHeaders()['content-type'][0];
        // $contentType = 'application/json'
        $content = $response->getContent();
        // $content = '{"id":521583, "name":"symfony-docs", ...}'
        $content = $response->toArray();
        // $content = ['id' => 521583, 'name' => 'symfony-docs', ...]

        return $content;
    }


    private function authenticate(): string
    {

        $apiKey = "2ce2eade1f564ac11d6aa762b7af299a";
        $authV4 = "eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiIyY2UyZWFkZTFmNTY0YWMxMWQ2YWE3NjJiN2FmMjk5YSIsInN1YiI6IjYyMDAyZDhjYTg4NTg3MDEwZDI1MjcxNyIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.6f-R0_fPO97I8B8cLmfY7-Rd0zG_MVlFKuOePBfn1MQ";
        $url = "https://api.themoviedb.org/3/movie/76341";

        $headers = [
            'Authorization' => 'Bearer ' . $authV4,        
            'Content-Type' => 'application/json;charset=utf-8'
        ];

        $client = new Client(['base_uri' => $url]);
        $response = $client->get('GET', [$url], $headers);

        var_dump($response->getStatusCode());

        $messages = [
            'You did it! You updated the system! Amazing!',
            'That was one of the coolest updates I\'ve seen all day!',
            'Great work! Keep going!',
        ];

        $index = array_rand($messages);

        return $messages[$index];
    }

    public function getTrends(): Array
    {
        $url = "https://api.themoviedb.org/3/trending/movie/day?api_key=2ce2eade1f564ac11d6aa762b7af299a";
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

        return $content;
    }
}