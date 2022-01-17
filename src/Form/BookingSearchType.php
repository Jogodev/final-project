<?php

namespace App\Form;

use App\Entity\BookingSearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class BookingSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('car', TextType::class, [
            //     'required'=> false,
            //     'label' => false,
            //     'attr' => [
            //         'placeholder'=>'Rechercher un modèle',
            //         'class' => 'form-control',
            //     ]
            // ])
            ->add('category', ChoiceType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Categorie',
                    'class' => 'form-control',

                ],
                'choices'=> [
                    'Tourisme' => 'tourisme',
                    'Sportive' => 'sportive',
                    'Utilitaire' => 'utilitaires',
                    
                ],
            ])
            ->add('maxPrice', IntegerType::class, [
                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Prix max',
                    'class' => 'form-control',

                ]
            ])
            ->add('energy', ChoiceType::class, [
                'label'=> false,
                'attr'=>[
                    'placeholder' => 'Carburant',
                    'class' => 'form-control'
                ],
                'choices'=> [
                    'Essence' => 'gas',
                    'Diesel' => 'diesel',
                    'Hybride' => 'Hybrid',
                    'Electrique' => 'electric',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => BookingSearch::class,
            'method' => 'get',
            '_csrf_token' => false,
        ]);
    }
}
