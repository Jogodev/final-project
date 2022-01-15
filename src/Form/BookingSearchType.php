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
            ->add('car', TextType::class, [
                'required'=> false,
                'label' => false,
                'attr' => [
                    'placeholder'=>'Rechercher un modèle',
                ]
            ])
            ->add('categories', ChoiceType::class, [
                'choices'=> [
                    'Essence' => 'gas',
                    'Diesel' => 'diesel',
                    'Hybride' => 'Hybrid',
                    'Electrique' => 'electric',
                ],
                'expanded'=> true,
                'multiple'=> true,
            ])
            ->add('maxPrice', IntegerType::class, [
                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Prix max'
                ]
            ])
            ->add('energy', ChoiceType::class, [
                'label'=> false,
                'attr'=>[
                    'placeholder' => 'Carburant'
                ],
                'choices'=> [
                    'Essence' => 'gas',
                    'Diesel' => 'diesel',
                    'Hybride' => 'Hybrid',
                    'Electrique' => 'electric',
                ],
                'expanded'=> true,
                'multiple'=> true,
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
