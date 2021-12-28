<?php

namespace App\Form;

use App\Entity\Bookings;
use App\Entity\Cars;
use App\Entity\Categories;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookingsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            // ->add('categories', ChoiceType::class,[
            //     'label' => 'Categories',
            //     'attr' => [ 'class' => 'form-control sm-3'],
            //     'choices' => [
            //         new Categories(Categories::)
            //     ],
            // ])
            ->add('cars', ChoiceType::class, [
                'label' => 'Vehicule',
                'attr' => ['class' => 'form-control'],
                'choices' => [
                    'Categories' => ['Voitures'=> [
                            
                    ], 'Utilitaires'=> [

                    ]],

                ],
                
            ])
            ->add('startDate', DateType::class, [
                'label' => 'Date de retrait',
                'required' => 'true',
                'widget' => 'single_text',
                'html5' => false,
                'attr' => [
                    'class' => 'form-control js-datepicker'
                ],

            ])
            ->add('endDate', DateType::class, [
                'label' => 'Date de retour',
                'required' => 'true',
                'widget' => 'single_text',
                'html5' => false,
                'attr' => [
                    'class' => 'form-control js-datepicker'
                ],
            ])
            ->add('Valider', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Bookings::class,
        ]);
    }
}
