<?php

namespace App\Controller;


use App\Entity\Sortie;
use App\Form\SortieType;
use App\Repository\SortieRepository;
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
    #[Route('/details/', name:'details_sortie', methods: ['GET','POST'])]
    public function details(SortieRepository $sortieRepo): Response{

        $sortie = $this->getDoctrine()->getRepository(Sortie::class)->findBy([],['created_at' => 'desc']);
        return $this->render('Sortie/details_sortie.html.twig',
            [
                'sortie' => $sortie,
            ]);
    }

}