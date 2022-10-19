<?php

namespace App\Controller\Admin;

use App\Entity\Membre;
use App\Entity\Slider;
use App\Entity\Chambre;
use App\Entity\Commande;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{   
    private $routeBuilder;

    public function __construct(AdminUrlGenerator $routebuilder)
    {
        $this->routeBuilder = $routebuilder;
    }
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Hotelhouse');
    }

    public function configureMenuItems(): iterable
    {
        return[
            MenuItem::linkToRoute("Retour à l'accueil", 'fas fa-arrow-left', 'app_app'),
            MenuItem::linkToDashboard('Dashboard', 'fa fa-home'),
            MenuItem::section('Gestion des données'),
            MenuItem::linkToCrud('Membre', 'fas fa-user', Membre::class),
            MenuItem::linkToCrud('Slider', 'fas fa-images', Slider::class),
            MenuItem::linkToCrud('Chambre', 'fas fa-bed', Chambre::class),
            MenuItem::linkToCrud('Commande', 'fas fa-cash-register', Commande::class)
        ];        
    }
}
