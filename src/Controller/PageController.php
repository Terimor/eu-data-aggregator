<?php


namespace App\Controller;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController
{
    /**
     * @Route("/import", methods={"GET"})
     */
    public function import(Request $request): Response
    {

    }

    /**
     * @Route("/observe", methods={"GET"})
     */
    public function observe(Request $request): Response
    {

    }
}