<?php

namespace App\Controller;

use App\Entity\Server;
use App\Form\ServerType;
use App\Repository\ServerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DsiController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        return $this->render('dsi/home.html.twig', [
            'controller_name' => 'DsiController',
        ]);
    }

    /**
     * @Route("/dsi", name="dsi")
     */
    public function index(ServerRepository $repo)
    {
        $servers=$repo->findAll();
        return $this->render('dsi/index.html.twig', [
            'controller_name' => 'DsiController',
            'servers' => $servers
        ]);
    }
    
    /**
     * @Route("/dsi/show/{id}", name="dsi_show", methods="GET|POST")
     */
    public function show( Server $server, Request $request, EntityManagerInterface $em)
    {
        $form = $this->createForm(ServerType::class, $server);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Serveur modifié avec success');

           return $this->redirectToRoute('dsi');
        }

        return $this->render('dsi/show.html.twig', [
            'controller_name' => 'DsiController',
            'server' => $server,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/dsi/new", name="dsi_new")
     */
    public function new( Request $request, EntityManagerInterface $em)
    {
        $server = new Server();
        $form = $this->createForm(ServerType::class, $server);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($server);
            $em->flush();
            $this->addFlash('success', 'Serveur créé avec success');

           return $this->redirectToRoute('dsi');
        }

        return $this->render('dsi/new.html.twig', [
            'controller_name' => 'DsiController',
            'server' => $server,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/dsi/show/{id}", name="dsi_delete", methods="DELETE")
     */ 
    public function delete( Server $server, Request $request, EntityManagerInterface $em)
    {
            //  if ($this->isCsrfTokenValid('delete' . $server->getId(), $request->get('token')))
            //  if ($this->isCsrfTokenValid('delete' . $server->getId(), $request->get('_token')))
            // if ($this->isCsrfTokenValid('delete' . $server->getId(), $request->request->get('token')))
            // if ($this->isCsrfTokenValid('delete' . $server->getId(), $request->request->get('_token')))
            //   {             return new Response ('Suppression');
            // }

            $em->remove($server);
            $em->flush();
            $this->addFlash('success', 'Serveur supprimé avec success');
   
        return $this->redirectToRoute('dsi');

    }
}



