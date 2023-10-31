<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/Sortie')]
class SortieController extends AbstractController
{
    #[Route('/', name: 'ajouter_sortie', methods: ['GET']) ]
    public function ajouterSortie(): Response
    {
        return $this->redirectToRoute("Sortie/ajout_sortie.html.twig");
    }
}