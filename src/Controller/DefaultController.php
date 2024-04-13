<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController {

    #[Route('/index', name: "index")]
    public function index_redirect()
    {
        return $this->redirectToRoute('main_page');
    }

    #[Route('/', name: "main_page")]
    public function index()
    {
        $request = Request::createFromGlobals();
        if($request->cookies->has('user'))
        {
            return $this->redirectToRoute('dashboard');  
        }
        else
        {
            return $this->redirectToRoute('login');
        }
    }
}