<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ContactFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
                ->add('prenom')
                ->add('nom')
                ->add('telephone')
                ->add('email')
                ->add('categorie', ChoiceType::class, [
                    'choices' => [
                        'General'=> "General",
                        'Chambre'=> "Chambre",
                        'Restaurant'=> "Restaurant",
                        'Spa'=> "Spa"
                    ]
                ])
                ->add('sujet')
                ->add('votredemande')
                ->add('avis')
            // ->add('date_enregistrement')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
