<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ShopsController extends AbstractController
{
    #[Route('/shops', name: 'app_shops')]
    public function index(): Response
    {
        return $this->render('shops/index.html.twig', [
            'controller_name' => 'ShopsController',
        ]);
    }
}
