<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Service\TmdbApi;
use Symfony\Contracts\HttpClient\HttpClientInterface;


class HomeController extends AbstractController
{

    private $pathImg = "https://www.themoviedb.org/t/p/w220_and_h330_face/";


    /**
     * @Route("/", name="index")
     */
    public function number(): Response
    {
        $number = random_int(0, 100);

        var_dump($this->getParameter('app.TMDB_API_KEY'));


        return $this->render('index.html.twig', [
            'number' => $number,
        ]);
    }


    /**
     *  @Route("/movies/latest", name="movies_latest")
     */
    public function getLatestMovies(TmdbApi $tmdbApi, HttpClientInterface $client): Response
    {
        $latest = $tmdbApi->getLatest();
        var_dump($latest);

        return new Response('Je suis latest movies');
    }


    /**
     * @Route("/movies/trends", name="movies_trends")
     */
    public function getTrendMovies(TmdbApi $tmdbApi): Response
    {
        $trends = $tmdbApi->getTrends();
        $latsTrends = array_slice($trends['results'], 0, 20);

        return $this->render('movies/trends.html.twig', ['last_trends' => $latsTrends, 'path_img' => $this->pathImg]);
    }


    /**
     * @Route("/movies/detail/{id}", name="movie_detail")
     */
    public function getMovieDetail(int $id, TmdbApi $tmdbApi): Response
    {
        $detail = $tmdbApi->getDetails($id);

        return $this->render('movies/detail.html.twig', ['detail' => $detail, 'path_img' => $this->pathImg]);
    }

    /**
     * @Route("/tv/trends", name="tv_trends")
     */
    public function getTrendsTv(TmdbApi $tmdbApi): Response
    {
        $trendsTv = $tmdbApi->getTrendsTv();
        var_dump($trendsTv);

        return new Response("Je suis getTrends");
    }

}