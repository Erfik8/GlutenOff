<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class UserTypeController extends AbstractController
{
    #[Route('/user/type', name: 'app_user_type')]
    public function index(): Response
    {
        return $this->render('user_type/index.html.twig', [
            'controller_name' => 'UserTypeController',
        ]);
    }
}
