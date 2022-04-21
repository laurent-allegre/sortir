<?php

namespace App\Form;

use App\Entity\Campus;
use App\Search\PropertySearch;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PropertySearchType extends AbstractType implements FormTypeInterface
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('campus', EntityType::class, [
                'label' => 'Campus',
                'required' => true,
                'class' => Campus::class
                ])

            ->add('q', TextType::class, [
                'label' => 'Le nom de la sortie contient :',
                'required' => false,
                'attr' => ['placeholder' => 'search']
                ])

            ->add('min', DateType::class,[
                'widget' => 'single_text',
                'label' => 'Entre',
                'required' => false,
                'attr' => ['class' => 'js-datepicker'],
                ])

            ->add('max', DateType::class,[
                'widget' => 'single_text',
                'label' => 'et :',
                'required' => false,
                'attr' => ['class' => 'js-datepicker'],
                ])

            ->add('isOrga', CheckboxType::class,[
                'label' => 'Sorties dont je suis l\'organisateur/trice',
                'required' => false,
                ])

            ->add('isInscrit', CheckboxType::class,[
                'label' => 'Sorties auxquelles je suis inscrit/e',
                'required' => false,
                ])

            ->add('isNotInscrit', CheckboxType::class,[
                'label' => 'Sorties auxquelles je ne suis pas inscrit/e',
                'required' => false,
                ])

            ->add('sortiesPassees', CheckboxType::class,[
                'label' => 'Sorties passées',
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PropertySearch::class,
            'method' => 'GET',
            'csrf_protection' => false
        ]);
    }
}
