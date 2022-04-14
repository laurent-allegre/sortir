<?php

namespace App\Form;

use App\Controller\AfficherSortie;
use App\Entity\Sortie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AfficherSortiePhpType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('dateHeureDebut')
            ->add('duree')
            ->add('dateLimiteInscription')
            ->add('nbInscriptionMax')
            ->add('infosSortie')
            ->add('etat')
            ->add('lieux', EntityType::class, [
                'class' => Sortie::class,
                'choice_label' => 'nom'
                ])
            //->add('etats')
            ->add('camps', EntityType::class, [
                'class' => Sortie::class,
                'choice_label' => 'nom'
            ])
            ->add('participants')
            ->add('organise')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Sortie::class,
        ]);
    }
}
