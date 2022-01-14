<?php

namespace App\Form;

use App\Entity\Bookings;
use App\Entity\Cars;
use App\Entity\Categories;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookingsType extends AbstractType
{    
    /**
     * Method buildForm
     *
     * @param FormBuilderInterface $builder [explicite description]
     * @param array $options [explicite description]
     *
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder


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
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Bookings::class,
        ]);
    }
}
