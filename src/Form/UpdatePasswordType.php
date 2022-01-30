<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\EqualTo;



class UpdatePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('currentPassword', PasswordType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Mot de passe actuel',
                    'class' => 'form-control',
                ],

            ])
            ->add('newPassword', PasswordType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Nouveau mot de passe',
                    'class' => 'form-control',
                ],
                // 'constraints' => [
                //     new Length([
                //         'min' => 6,
                //         'minMessage' => 'Le mot de passe doit contenir au moins 6 caratcères',
                //         'max' => 100,
                //         'maxMessage' => 'Le mot de passe doit contenir au maximum 100 caractères'
                //     ]),
                //     new EqualTo([
                //         'propertyPath' => 'newPassword',
                //         'message' => 'Le mot de passe de confirmation ne correspond pas au nouveau mot de passe',
                //     ])
                // ]

            ])->add('confirmPassword', PasswordType::class, [
                'label' => false,               
                'attr' => [
                    'placeholder' => 'Confirmation nouveau mot de passe',
                    'class' => 'form-control',
                ],
                // 'constraints' => [
                //     new EqualTo([
                //         'propertyPath' => 'newPassword',
                //         'message' => 'Le mot de passe de confirmation ne correspond pas au nouveau mot de passe',
                //     ])
                // ]

            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            
        ]);
    }
}
