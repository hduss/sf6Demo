<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Service\AuthenticationApi;
use Symfony\Contracts\HttpClient\HttpClientInterface;


class HomeController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function number(): Response
    {
        $number = random_int(0, 100);

        return $this->render('index.html.twig', [
            'number' => $number,
        ]);
    }

    /**
     *  @Route("/movies/latest")
     */
    public function getLatestMovies(AuthenticationApi $authenticationApi, HttpClientInterface $client): Response
    {
        $authApi = $authenticationApi->authenticateHttp($client);
        var_dump($authApi);

        return new Response('Je usis la');
    }

    /**
     * @Route("/movies/trend")
     */
    public function getTrendMovies(): Response
    {
        

        return new Response('Je suis trend movies');
    }

}