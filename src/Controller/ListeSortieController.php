<?php

namespace App\Controller;

use App\Repository\SerieRepository;
use App\Repository\SortieRepository;
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
            'sorties'=>$sorties
        ]);
    }

}
