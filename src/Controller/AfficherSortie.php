<?php

namespace App\Controller;

use App\Entity\Sortie;
use App\Form\AfficherSortiePhpType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AfficherSortie extends AbstractController
{
/**
 * @Route("/affichersortie", name="sortie/afficher")
 */

public function create(Request $request, EntityManagerInterface $entityManager): Response
{
    $afficher = new Sortie();
    $afficherForm = $this->createForm(AfficherSortiePhpType::class, $afficher);
    $afficherForm->handleRequest($request);

    if ($afficherForm->isSubmitted() && $afficherForm->isValid()){
        $entityManager->persist($afficher);
        $entityManager->flush();
    }
    return $this->render('AfficherSortie.html.twig', [
        'afficherForm' => $afficherForm->createView()

    ]);

}
}