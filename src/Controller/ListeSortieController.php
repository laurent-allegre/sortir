<?php

namespace App\Controller;


use App\Repository\ParticipantRepository;
use App\Repository\SortieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListeSortieController extends AbstractController
{
    /**
     * @Route("/accueil", name="accueil")
     */
    public function index(SortieRepository $sortieRepository): Response
    {
        $sorties = $sortieRepository->findAll();

        return $this->render('Accueil/accueil.html.twig', [
            'controller_name' => 'ListeSortieController',
            'sorties'=>$sorties,
        ]);
    }
    /**
     * @Route("/accueil", name="inscrire")
     */
    public function inscrire(EntityManagerInterface $entityManager): Response
    {
        $participant=$this->getUser();

        $entityManager->persist($participant);
        $entityManager->flush();

        return $this->render('Accueil/accueil.html.twig', [
            'controller_name' => 'ListeSortieController',
        ]);
    }

}
