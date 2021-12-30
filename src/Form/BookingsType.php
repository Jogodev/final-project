<?php

namespace App\Form;

use App\Entity\Bookings;
use App\Entity\Cars;
use App\Entity\Categories;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookingsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder


            ->add('cars', EntityType::class, [
                'label' => 'Vehicule',
                'attr' => ['class' => 'form-control'],
                'class' => Cars::class,
                'choice_label' => 'title',

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
                    'class' => 'form-control g-col-6 js-datepicker'
                ],
            ])
            ->add('Valider', SubmitType::class,[
                'attr' => ['class'=>'btn btn-primary btn-lg',]
                
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Bookings::class,
        ]);
    }
}
