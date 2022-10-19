<?php

namespace App\Form;

use App\Entity\Membre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add ('pseudo')
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options'=>['label'=> 'Mot de passe'],
                'second_options'=>['label'=>'Confirmez votre mot de passe'],
                'invalid_message'=> 'Les mots de passe ne correspondent pas.',

                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('prenom')
            ->add('nom')
            ->add('email')
            ->add('civilite', ChoiceType::class, [
                'choices' => [
                    'Monsieur'=> "M",
                    'Madame'=> "F",
                    'Autre'=> "T"
                ]
            ]
        )
        ->add('roles', ChoiceType::class, [
              'choices'=> [
                'Admin'=> "ROLE_ADMIN",
                    'Membre'=> "ROLE_USER"
                ],
                    'expanded'=>true,
                    'multiple'=>true
            ])
 
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Membre::class,
        ]);
    }
}
