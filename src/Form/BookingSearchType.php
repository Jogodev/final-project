<?php

namespace App\Form;

use App\Entity\BookingSearch;
use App\Entity\Categories;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
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
            ->add('categories', EntityType::class, [
                'label' => 'Categorie',
                'required' => false,
                'class' => Categories::class,                                
                'attr' => [                   
                    'class' => 'form-control'
                ],
            ])
            ->add('maxPrice', IntegerType::class, [
                'label' => 'Prix max',
                'required' => false,
                'attr' => [
                    'class' => 'form-control'
                ],
            ])
            ->add('energy', ChoiceType::class, [
                'label' => 'Carburant',
                'required' => false,
                'attr' => [
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
