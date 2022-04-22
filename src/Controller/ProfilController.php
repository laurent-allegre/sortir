<?php

namespace App\Controller;



use App\Form\ProfilType;
use App\Repository\ParticipantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;




/**
 * @Route("/profil")
 */
class ProfilController extends AbstractController
{

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

}
