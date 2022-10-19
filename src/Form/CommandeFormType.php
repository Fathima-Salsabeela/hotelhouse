<?php

namespace App\Form;

use App\Entity\Chambre;
use App\Entity\Commande;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class CommandeFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
                
                ->add('chambre', EntityType::class,[
                    'class' =>Chambre::class,
                    'choice_label' =>'titre'])
                ->add('date_arivee', DateType::class, [
                    'widget' => 'single_text',
                    
                ])
                ->add('date_depart', DateType::class, [
                    'widget' => 'single_text',
                    
                ])
                // ->add('prix_total')
                ->add('prenom')
                ->add('nom')
                ->add('telephone')
                ->add('email')
                // ->add('date_enregistrement')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Commande::class,
        ]);
    }
}
