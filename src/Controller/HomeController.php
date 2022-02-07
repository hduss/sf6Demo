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
     * @Route("/movies/trends")
     */
    public function getTrendMovies(AuthenticationApi $authenticationApi, HttpClientInterface $client): Response
    {

        $pathImg = "https://www.themoviedb.org/t/p/w220_and_h330_face/";
        $test = new $authenticationApi($client);
        $trends = $authenticationApi->getTrends();
        $latsTrends = array_slice($trends['results'], 0, 20);
        echo '<pre>';
        var_dump($latsTrends);
        echo '</pre>';
        return $this->render('movies/index.html.twig', ['last_trends' => $latsTrends, 'path_img' => $pathImg]);

        // return new Response('Je suis trend movies');
    }

    /**
     * @Route("/movies/detail/{id}", name="movie_detail")
     */
    public function getMovieDetail(int $id, AuthenticationApi $authenticationApi, HttpClientInterface $client): Response
    {
        var_dump($id);

        $test = new $authenticationApi($client);
        $detail = $authenticationApi->getDetails($id);

        // echo '<pre>';
        // var_dump($detail);
        // echo '</pre>';

        return $this->render('movies/detail.html.twig', ['detail' => $detail]);

        // return new Response('Je suis une response');

    }

}