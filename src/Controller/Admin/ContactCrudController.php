<?php

namespace App\Controller\Admin;

use App\Entity\Contact;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;

use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ContactCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Contact::class;
    }
   
    public function configureActions(Actions $actions): Actions
    {
    return $actions->remove(Crud::PAGE_INDEX, Action::NEW);
    }
    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('prenom'),
            TextField::new('nom'),
            TextField::new('email'),
            TextField::new('telephone'),
            TextField::new('categorie'),
            TextField::new('sujet'),
            TextField::new('votredemande'),
            TextField::new('avis'),
        ];
            
    }

    public function createEntity(string $entityFqcn)
    {
        $pr = new $entityFqcn;
        $pr->setDateEnregistrement(new \DateTime);
        return $pr;
    }

    
}
