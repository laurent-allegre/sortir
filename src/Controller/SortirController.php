<?php

namespace App\Controller;



use App\Entity\Sortie;
use App\Form\SortieType;
use App\Repository\CampusRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SortirController extends AbstractController
{
    /**
     * @Route("/sortie", name="sortie/creation")
     * @Route("/sortie/{id}/modif", name="sortie/modif")
     */
    public function form(Sortie $sortie = null, Request $request, EntityManagerInterface $entityManager, CampusRepository $campusRepository): Response
    {
        if (!$sortie){
            $sortie = new Sortie();
        }

       $sortieForm = $this->createForm(SortieType::class, $sortie);
       $sortieForm->handleRequest($request);

       if ($sortieForm->isSubmitted() && $sortieForm->isValid()){
            //organisateur
            $sortie->setOrganise($this->getUser());
            //campus
            $sortie->setCamps($this->getUser()->getCampu());

           $entityManager->persist($sortie);
           $entityManager->flush();

           //s'affiche sur la page d'acceuil
           //  $this->addFlash('success', "La sortie a été créée");
           return $this->redirectToRoute('accueil');
       }
            //TODO changer la route de sortie apres validation
        return $this->render('sortie.html.twig', [
            'sortieForm' => $sortieForm->createView(),
            'sortie' => $sortie,
            'editMode' => $sortie->getId() !== null
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
