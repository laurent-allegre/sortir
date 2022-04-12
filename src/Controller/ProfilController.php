<?php

namespace App\Controller;

use App\Entity\Participant;
use App\Form\ProfilType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfilController extends AbstractController
{

    /**
     * @Route("/profil", name="app_profil")
     */
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $profil = new Participant();


        $profilForm = $this->createForm(ProfilType::class, $profil);
        $profilForm->handleRequest($request);

        if ($profilForm->isSubmitted()) {
            $entityManager->persist($profil);
            $entityManager->flush();
            //return $this->redirectToRoute('profil/profil.html.twig', ['id' => $profil->getId()]);
        }


        return $this->render('profil.html.twig', [
            'profilForm' => $profilForm->createView()
        ]);
    }
}
