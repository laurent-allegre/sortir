<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListeSortieController extends AbstractController
{
    /**
     * @Route("/sortie/liste", name="app_liste_sortie")
     */
    public function index(): Response
    {
        return $this->render('liste_sortie/index.html.twig', [
            'controller_name' => 'ListeSortieController',
        ]);
    }
}
