<?php

namespace App\Controller;

use App\Entity\Adresses;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AdressesController extends AbstractController
{
    #[Route('/adresses', name: 'app_adresses')]
    public function index(): Response
    {
        return $this->render('adresses/index.html.twig', [
            'controller_name' => 'AdressesController',
        ]);
    }
}
