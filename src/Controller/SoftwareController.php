<?php

namespace App\Controller;

use App\Entity\Software;
use App\Repository\SoftwareRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SoftwareController extends AbstractController
{
    /**
     * @Route("/software", name="software")
     */
    public function index(SoftwareRepository $repo)
    {
        $softwares=$repo->findAll();
        return $this->render('software/index.html.twig', [
            'controller_name' => 'SoftwareController',
            'softwares' => $softwares
        ]);
    }

    /**
     * @Route("/software/show/{id}", name="software_show", methods="GET|POST")
     */
    public function show( Software $softare, Request $request, EntityManagerInterface $em)
    {
        $form = $this->createForm(ServerType::class, $server);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Serveur modifié avec success');

           return $this->redirectToRoute('software');
        }

        return $this->render('software/show.html.twig', [
            'controller_name' => 'DsiController',
            'server' => $server,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/software/new", name="software_new")
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
     * @Route("/software/show/{id}", name="software_delete", methods="DELETE")
     */ 
    public function delete( Software $software, Request $request, EntityManagerInterface $em)
    {

            $em->remove($server);
            $em->flush();
            $this->addFlash('success', 'Serveur supprimé avec success');
   
        return $this->redirectToRoute('software');
    }
}
