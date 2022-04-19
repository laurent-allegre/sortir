<?php

namespace App\Form;

use App\Entity\Campus;
use App\Entity\Etat;
use App\Entity\Lieu;
use App\Entity\Sortie;
use App\Entity\Ville;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AfficherSortiePhpType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom',EntityType::class,[
                    'class'=>Sortie::class,
                    'choice_label'=>'nom',
                    'label'=>'Nom de la sortie',

            ])
            ->add('dateHeureDebut', DateTimeType::class, [
                'widget' => 'single_text',
                'label'         => 'Début de la sortie',
                'attr' => ['class' => 'js-datepicker'],
            ])

            ->add('dateLimiteInscription', EntityType::class,[
                'class'=>Sortie::class,
                'choice_label'=>'duree',
                'label'=>'Durée de la sortie',

            ])
            ->add('nbInscriptionMax', EntityType::class,[
                'class'=>Sortie::class,
                'choice_label'=>'nb_inscription_max',
                'label'=>'Nombre de place',

    ])
            ->add('infosSortie')

            ->add('lieux', EntityType::class,[
                'class' => Lieu::class,
                'choice_label'=> 'nom',
            ])
           /* ->add('etats', EntityType::class,[
                'class' => Etat::class,
                'choice_label' => 'libelle'
            ])*/
            ->add('camps',EntityType::class,[
                'label' => 'Campus',
                'class' => Campus::class,
                'choice_label'=> 'nom'
            ])
            ->add('ville', EntityType::class,[
                'mapped'=> false,
                'class' => Ville::class,
                'choice_label' => 'nom'
            ])
            ->add('latitude', EntityType::class,[
                'mapped' => false,
                'class' => Lieu::class,
                'choice_label'=> 'latitude',
            ])
            ->add('longitude', EntityType::class,[
                'mapped' => false,
                'class' => Lieu::class,
                'choice_label'=> 'longitude',
            ])

            //  ->add('participants')
            //  ->add('organise')

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Sortie::class,
        ]);
    }
}
