<?php

namespace App\Controller;

use App\Entity\Lieu;
use App\Entity\Sortie;
use App\Form\SortieType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SortirController extends AbstractController
{
    /**
     * @Route("/sortie", name="sortie/creation")
     */
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
       $sortie = new Sortie();
       $sortieForm = $this->createForm(SortieType::class, $sortie);

       $sortieForm->handleRequest($request);
       if ($sortieForm->isSubmitted() && $sortieForm->isValid()){
           $entityManager->persist($sortie);
           $entityManager->flush();
       }

        return $this->render('sortie.html.twig', [
            'sortieForm' => $sortieForm->createView()
        ]);
    }
    /**
     *
     * @Route ("/delete/{id}", name="sortie/delete" )
     */
    public function delete(Sortie $sortie, EntityManagerInterface $entityManager){
        $entityManager->remove($sortie);
        $entityManager->flush();

        return $this->redirectToRoute('index');
    }

}
