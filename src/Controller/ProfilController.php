<?php

namespace App\Controller;


use App\Entity\Participant;
use App\Form\ProfilType;
use App\Repository\CampusRepository;
use App\Repository\ParticipantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;



/**
 * @Route("/profil")
 */
class ProfilController extends AbstractController
{
  // TODO à enlever
  /* /**
     * @Route("/profil", name="app_profil")
     */
  /* public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $participant = new Participant();
        $participant->setAdministrateur(false);
        $participant->setActif(true);

        $profilForm = $this->createForm(ProfilType::class, $participant);
        $profilForm->handleRequest($request);

        if ($profilForm->isSubmitted()) {
            $entityManager->persist($participant);
            $entityManager->flush();
            return $this->redirectToRoute('app_profil_update', ['id' => $participant->getId()]);
        }
        return $this->render('profil.html.twig', [
            'profilForm' => $profilForm->createView()
        ]);
    } */
    /**
     * @Route("/", name="app_profil", methods={"GET", "POST"})
     */
    public function edit(Request $request,EntityManagerInterface $em): Response
    {
        $participant=$this->getUser();


        $profilForm = $this->createForm(ProfilType::class, $participant)->handleRequest($request);
        if ($profilForm->isSubmitted() && $profilForm->isValid()) {

            $participant = $profilForm->getData();
            $em->persist($participant);
            $em->flush();

            return $this->redirectToRoute('app_show', ['id' => $participant->getId()]);
        }

        return $this->renderForm('profil.html.twig', [
            'participant' => $participant,
            'profilForm' => $profilForm,

        ]);

    }
    /**
     * @Route("/{id}", name="app_show", methods={"GET"})
     */
    public function show(int $id,ParticipantRepository $participantRepository): Response
    {
        $participant = $participantRepository->find($id);
        return $this->render('participant.html.twig', [
            'participant' => $participant,

        ]);
    }
    // Todo : à enlever
   /* /**
     * @Route("/update/{id}")
     */
  /*  public function update(ManagerRegistry $doctrine, int $id): Response
    {
        $entityManager = $doctrine->getManager();
        $participant = $entityManager->getRepository(ParticipantRepository::class)->find($id);



        if (!$participant) {
            throw $this->createNotFoundException(
                'No user found for id '.$id
            );
        }

        $participant->setPseudo('New product name!');
        $entityManager->flush();

        return $this->redirectToRoute('app_show', [
            'id' => $participant->getId()
        ]);
    }*/
}
