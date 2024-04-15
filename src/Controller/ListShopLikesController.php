<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ListShopLikesController extends AbstractController
{
    #[Route('/list/shop/likes', name: 'app_list_shop_likes')]
    public function index(): Response
    {
        return $this->render('list_shop_likes/index.html.twig', [
            'controller_name' => 'ListShopLikesController',
        ]);
    }
}
