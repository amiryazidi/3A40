<?php

namespace App\Controller;

use App\Repository\StadeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StadeController extends AbstractController
{
    #[Route('/stade', name: 'app_stade')]
    public function index(): Response
    {
        return $this->render('stade/index.html.twig', [
            'controller_name' => 'StadeController',
        ]);
    }

    #[Route('/stades', name: 'stades')]
    public function stades(StadeRepository $repo): Response
    {
        return $this->render('stade/list.html.twig', [
            'response' => $repo->findAll()
        ]);
    }
}
