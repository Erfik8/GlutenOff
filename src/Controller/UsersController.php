<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Users;

class UsersController extends AbstractController
{
    #[Route('/users', name: 'app_users')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $users = $entityManager->getRepository(Users::class)->findAll();

        return $this->render('users/index.html.twig', [
            'controller_name' => 'UsersController',
            'users' => $users
        ]);
    }
}
