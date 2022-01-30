<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\Length;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'required'=>true,
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('email', EmailType::class,  [
                'required'=>true,
                'attr' => [
                    'class' => 'form-control'
                ]
            ])

            ->add('sujet', ChoiceType::class,  [
                'required'=>true,
                'choices'=>[
                    'Vente'=>'Vente',
                    'Location'=>'Location'
                ],
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('message', TextareaType::class, [
                'required'=>true,
                'attr' => [
                    'class' => 'form-control',
                    'rows' => 5,
                ],
                'constraints' => [
                    new Length([
                        'min'=>50,
                        'minMessage' => 'Votre message doit contenir au minimum 50 caractères',
                        'max' => 500,
                        'maxMessage' => 'Votre message doit contenir au maximum 500 caractères',
                    ])
                ]
            ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
