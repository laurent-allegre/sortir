<?php

namespace App\Controller;

use App\Entity\Participant;
use App\Form\ProfilType;
use App\Repository\ParticipantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
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
        $participant = new Participant();
        $participant->setAdministrateur(false);
        $participant->setActif(true);

        $profilForm = $this->createForm(ProfilType::class, $participant);
        $profilForm->handleRequest($request);

        if ($profilForm->isSubmitted()) {
            $entityManager->persist($participant);
            $entityManager->flush();
            //return $this->redirectToRoute('app_profil', ['id' => $participant->getId()]);
        }


        return $this->render('profil.html.twig', [
            'profilForm' => $profilForm->createView()
        ]);
    }

    /**
     * @Route("detail/{id}", name="app_show", methods={"GET"})
     */
    public function show(int $id, Participant $participant, ParticipantRepository $participantRepository): Response
    {
        $participant = $participantRepository->find($id);
        return $this->render('show.html.twig', [
            'participant' => $participant,
        ]);
    }
}
