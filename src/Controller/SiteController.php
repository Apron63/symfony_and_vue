<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SiteController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     * @return Response
     */
    public function homepageAction(): Response
    {
        return $this->render('site/homepage.html.twig');
    }

    /**
     * @return Response
     */
    public function error(): Response
    {
        return $this->render('site/404.html.twig');
    }
}