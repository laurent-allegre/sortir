<?php

namespace App\DataFixtures;

use App\Entity\Etat;
use App\Entity\Participant;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

// Ajout de FakerPHP
// https://fakerphp.github.io/formatters
use Faker;

// PasswordHasher
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    // private UserPasswordHasherInterface $hasher;
    private $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        // https://fakerphp.github.io/locales/fr_FR
        $faker = Faker\Factory::create('fr_FR');

        // Génère 20 participants
        for ($i = 0; $i < 20; $i++) {

            $participant = new Participant();
            $participant->setEmail($faker->email());
            $participant->setNom($faker->firstName());
            $participant->setPrenom($faker->lastName());
            $participant->setTelephone($faker->phoneNumber());
            $participant->setPseudo($faker->word())    ;

            $participant->setAdministrateur(false);
            $participant->setActif(true);
         //   $participant->setCampu($faker->numberBetween(1, 3));



            // POINTS PARTICULIERS :

            // Rôle par défaut
            $participant->setRoles( ["ROLE_USER"] );

            // Mot de passe = doit être hashé
            $plainPassword = "azerty";

            $hash = $this->hasher->hashPassword($participant, $plainPassword);
            $participant->setPassword($hash);

            $manager->persist($participant);
        }

        $manager->flush();
    }
}