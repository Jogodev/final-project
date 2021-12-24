<?php

namespace App\Form;

use App\Entity\Bookings;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookingsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('cars', ChoiceType::class, [
                'choices' => [
                    
                ]
            ])
            ->add('startDate', DateType::class, [
                'label' => 'Date de retrait',
                'required' => 'true',
            ])
            ->add('endDate', DateType::class, [
                'label' => 'Date de retour',
                'required' => 'true',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Bookings::class,
        ]);
    }
}
