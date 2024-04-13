<?php

// src/Controller/SecurityController.php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SecurityController extends AbstractController {

    #[Route('/login', name: "login")]
    public function login()
    {
        $request = Request::createFromGlobals();
        if ($request->getMethod() == 'POST')
        {
            return $this->render('login.html.twig', ['message' => $request->getMethod() ]);
        }
        else 
        {
            return $this->render('login.html.twig', ['message' => 'Welcome']);
        }
    }

    #[Route('/register', name: "register")]
    public function register()
    {
        $request = Request::createFromGlobals();
        if ($request->getMethod() == 'POST')
        {
            return $this->render('register.html.twig', ['message' => $request->getMethod() ]);
        }
        else 
        {
            return $this->render('register.html.twig', ['message' => 'Welcome']);
        }
    }

    #[Route('/logout')]
    public function logout()
    {
        $request->getMethod();
    }
}