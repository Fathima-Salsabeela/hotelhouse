<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Form\CommandeFormType;
use App\Repository\SliderRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class AppController extends AbstractController
{   
    #[Route('/app', name: 'app_app')]
    public function index(SliderRepository $repo_slider): Response
    {
        $photos=$repo_slider->findAll();
        return $this->render('app/index.html.twig', [
            'controller_name' => 'AppController',
            'photos'=>$photos
        ]);
    }

    

    #[Route('/architecture', name: 'app_architecture')]
    public function architecture(SliderRepository $repo_slider): Response
    {
        $photos=$repo_slider->findAll();
        return $this->render('app/architecture.html.twig', [
            'photos'=>$photos
        ]);
    }

    #[Route("/reservation", name:"reservation")]
public function formCommande(SliderRepository $repo_slider, Commande $commande = null, EntityManagerInterface $manager, Request $request)
{
    $photos=$repo_slider->findAll();
    if (!$commande) {
        $commande = new Commande;
        $commande->setDateEnregistrement(new \DateTime());
    }
    $form = $this->createForm(CommandeFormType::class, $commande);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
        $depart = $commande->getDateDepart();
        $arrivee = $commande->getDateArivee();

        if ($arrivee->diff($commande->getDateDepart())->invert == 1) {
            $this->addFlash('danger', 'Une période de temps ne peut pas être négative.');
            return $this->redirectToRoute('reservation');
        }
        $days = $depart->diff($commande->getDateArivee())->days;
        $prixTotal = ($commande->getChambre()->getPrixJournalier() * $days) + $commande->getChambre()->getPrixJournalier();
        $commande->setPrixTotal($prixTotal);
        $manager->persist($commande);
        $manager->flush();
        $this->addFlash('success', 'La réservation a bien été Créer !');
        return $this->redirectToRoute('app_app');
    }
    return $this->renderForm('app/reservation.html.twig', [   
        'form' => $form,
        'photos'=>$photos
    ]);
}
      
  #[Route("/chambre", name:"chambre")]
  public function chambre(SliderRepository $repo_slider)
  {
    $photos=$repo_slider->findAll();
    return $this->render('app/chambre.html.twig', [
        'photos'=>$photos
    ]);
  }
  #[Route("/actualite", name:"actualite")]
  public function actualite(SliderRepository $repo_slider)
  {
    $photos=$repo_slider->findAll();
    return $this->render('app/actualite.html.twig', [
        'photos'=>$photos
    ]);
  }
  #[Route("/avis", name:"avis")]
  public function avis(SliderRepository $repo_slider)
  {
    $photos=$repo_slider->findAll();
    return $this->render('app/avis.html.twig', [
        'photos'=>$photos
    ]);
  }

  #[Route("/contact", name:"contact")]
  public function contact(SliderRepository $repo_slider)
  {
    $photos=$repo_slider->findAll();
    return $this->render('app/contact.html.twig', [
        'photos'=>$photos
    ]);
  }
  #[Route("/hotel", name:"hotel")]
  public function hotel(SliderRepository $repo_slider)
  {
    $photos=$repo_slider->findAll();
    return $this->render('app/hotel.html.twig', [
        'photos'=>$photos
    ]);
  }

  #[Route("/restaurant", name:"restaurant")]
  public function restaurant(SliderRepository $repo_slider)
  {
    $photos=$repo_slider->findAll();
    return $this->render('app/restaurant.html.twig', [
        'photos'=>$photos
    ]);
  }

  #[Route("/spa", name:"spa")]
  public function spa(SliderRepository $repo_slider)
  {
    $photos=$repo_slider->findAll();
    return $this->render('app/spa.html.twig', [
        'photos'=>$photos
    ]);
  }

}
    