<?php

namespace App\Controller;

use App\Entity\Participant;
use App\Entity\Sortie;
use App\Entity\Lieu;
use App\Repository\CampusRepository;
use App\Repository\ParticipantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

class AfficherSortie extends AbstractController
{
    /**
     * @Route("afficheSortie/{id}", name="sortie_afficheSortie", requirements={"id":"\d+"})
     * @return Response
     */
    public function sortie(Sortie $sortie)
    {
        return $this->render('AfficherSortie.html.twig', [
            "sortie" => $sortie
        ]);
    }

}