<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

Class AccountController extends AbstractController
{

    /**
     * @Route("/account", name="account")
     */
    public function account(): Response
    {
        return new Response('Je suis account');
    }


    /**
     * @Route("/account/login", name="account_login")
     */
    public function login(): Response
    {
        return new Response('Je suis login');
    }

}