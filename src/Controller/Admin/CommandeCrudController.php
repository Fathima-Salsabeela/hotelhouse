<?php

namespace App\Controller\Admin;

use App\Entity\Chambre;
use App\Entity\Commande;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CommandeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Commande::class;
    }

    public function configureActions(Actions $actions): Actions
     {
     return $actions->remove(Crud::PAGE_INDEX, Action::NEW);
     }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('chambre', 'Chambre'),
            ChoiceField::new('chambre')->setChoices(["Chambre Clasique" => "Chambre Clasique", "Chambre Confort" => "Chambre Confort", "Chambre Suite" => "Chambre Suite"])->onlyOnForms(),
            DateField::new('date_arivee', "Date de arrivee")->setFormat('d/M/Y à H:m:s')->hideOnForm(),
            DateField::new('date_depart', "Date de paiement")->setFormat('d/M/Y à H:m:s')->hideOnForm(),
            MoneyField::new('prix_total')->setCurrency('EUR')->hideOnForm(),
            TextField::new('prenom'),
            TextField::new('nom'),
            TelephoneField::new('telephone'),
            TextField::new('email'),
            DateTimeField::new('date_enregistrement')->setFormat('d/M/Y à H:m:s')->hideOnForm(),
            
        ];
    }
    public function createEntity(string $entityFqcn)
    {
        $commande = new $entityFqcn;
        $commande->setDateEnregistrement(new \DateTime);
        return $commande;

    }

    
}
