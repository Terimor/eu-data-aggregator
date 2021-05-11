<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    /**
     * @Route("/import", methods={"GET"})
     */
    public function import(Request $request): Response
    {
        return $this->render('page/import.html.twig');
    }

    /**
     * @Route("/observe", methods={"GET"})
     */
    public function observe(Request $request): Response
    {
        return $this->render('page/observe.html.twig');
    }
}