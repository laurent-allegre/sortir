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
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SortieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('dateHeureDebut', DateTimeType::class,[
                'html5' => true,
                'widget'=>'single_text',
            ])
            ->add('duree')
            ->add('dateLimiteInscription', DateType::class,[
                 'html5' => true,
                 'widget'=>'single_text',
            ])
            ->add('nbInscriptionMax')
            ->add('infosSortie')

            ->add('lieux', EntityType::class,[
                'class' => Lieu::class,
                'choice_label'=> 'nom',
            ])
            ->add('etats', EntityType::class,[
                'class' => Etat::class,
                'choice_label' => 'libelle'
            ])
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
        /*    ->add('latitude', EntityType::class,[
                'mapped' => false,
                'class' => Lieu::class,
                'choice_label'=> 'latitude',
            ])
            ->add('longitude', EntityType::class,[
                'mapped' => false,
                'class' => Lieu::class,
                'choice_label'=> 'longitude',
            ]) */

          //  ->add('participants')
          // ->add('organise')

        ;
    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Sortie::class,
        ]);
    }
}
