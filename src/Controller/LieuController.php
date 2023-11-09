<?php

namespace App\Controller;

use App\Entity\Lieu;
use App\Form\LieuType;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LieuController extends AbstractController
{

    #[Route('/lieu/ajouter', name: 'ajouter_lieu', methods: ['GET', 'POST'])]
    public function ajouter_Lieu(Request $request, EntityManagerInterface $em): Response
    {
        $lieu = new Lieu();
        $lieuForm = $this->createForm(LieuType::class, $lieu);

        $lieuForm->handleRequest($request);

        if($lieuForm->isSubmitted() && $lieuForm->isValid()){

            $em->persist($lieu);
            $em->flush();

            $this->addFlash('success', 'Lieu ajoutée avec succés');
            return $this->redirectToRoute('ajouter_sortie');
        }

        return $this->render("/lieu/ajouter_lieu.html.twig", [
            'lieuForm' => $lieuForm
        ]);
    }
}