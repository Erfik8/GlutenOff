<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ListProductUserController extends AbstractController
{
    #[Route('/list/product/user', name: 'app_list_product_user')]
    public function index(): Response
    {
        return $this->render('list_product_user/index.html.twig', [
            'controller_name' => 'ListProductUserController',
        ]);
    }
}
