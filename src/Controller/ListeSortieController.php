<?php

namespace App\Controller;


use App\Entity\Participant;
use App\Entity\Sortie;
use App\Repository\ParticipantRepository;
use App\Repository\SortieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/accueil", name="accueil")
 */
class ListeSortieController extends AbstractController
{
    /**
     * @Route("/", name="")
     */
    public function index(SortieRepository $sortieRepository): Response
    {
        $participant=$this->getUser();
        // $search = new SortiesSearch();
        // $sortiesSearchForm = $this->createForm(SortiesSearchType::class, $search);
        // $sortiesSearchForm->handlerequest($request);
        $sorties = $sortieRepository->findAll();
        return $this->render('Accueil/accueil.html.twig', [
            'controller_name' => 'ListeSortieController',
            'sorties'=>$sorties,
            'participant'=>$participant,

        ]);
    }


    /**
     * @Route("/{id}", name="inscrire", requirements={"id":"\d+"})
     */
      public function inscription(Sortie $sortie, EntityManagerInterface $manager)
    {
        //--- insertion du user dans la table sortie ---
        //**********
        //récupération du user connecté
        /**
         * @var Participant $participant
         */

        $participant = $this->getUser();
        $sortie->addParticipant($participant);

        $manager->persist($sortie);
        $manager->flush();


        return $this->redirectToRoute('accueil');
    }

    /**
     * @Route("/remove/{id}", name="desister", requirements={"id":"\d+"})
     */
    public function desister(Sortie $sortie, EntityManagerInterface $manager)
    {
        /**
         * @var Participant $participant
         */
        $participant = $this->getUser();
        $sortie->removeParticipant($participant);
        $manager->flush();

        return $this->redirectToRoute('accueil');
    }
}