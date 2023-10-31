<?php

namespace App\Controller;


use App\Entity\Sortie;
use App\Form\SortieType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/sortie')]
class SortieController extends AbstractController
{
    #[Route('/ajouter', name: 'ajouter_sortie', methods: ['GET','POST']) ]
    public function ajouterSortie(): Response
    {
        $sortie = new Sortie();
        $sortieForm = $this->createForm(SortieType::class);

        return $this->render("Sortie/ajout_sortie.html.twig", [
            'sortieForm' => $sortieForm
        ]);
    }
}