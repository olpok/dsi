<?php

namespace App\Controller;

use App\Repository\ServerRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DsiController extends AbstractController
{
    /**
     * @Route("/dsi", name="dsi")
     */
    public function index(ServerRepository $repo)
    {
        // $servers=$repo->findAll();
        return $this->render('dsi/index.html.twig', [
            'controller_name' => 'DsiController',
        ]);
    }

    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        return $this->render('dsi/home.html.twig', [
            'controller_name' => 'DsiController',
        ]);
    }
}



