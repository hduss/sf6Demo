<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


Class AjaxController extends AbstractController
{


    /**
     * @Route("/api/addlist", name="add_in_list")
     */
    public function addInList(): Response
    {
        return $this->json(['username' => 'jane.doe']);
    }

    /**
     * @Route("/api/like", name="like_item")
     */
    public function likeItem(): Response
    {
        return new Response("Like item");
    }

}