<?php

namespace App\Controller;


use App\Entity\Etat;
use App\Entity\Sortie;
use App\Form\SortieType;
use App\Repository\SortieRepository;
use Doctrine\DBAL\Types\StringType;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\String_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/sortie')]
class SortieController extends AbstractController
{
    #[Route('/ajouter', name: 'ajouter_sortie', methods: ['GET','POST']) ]
    public function ajouterSortie(Request $request, EntityManagerInterface $em): Response
    {
        $sortie = new Sortie();
        $sortieForm = $this->createForm(SortieType::class, $sortie);

        $sortieForm->handleRequest($request);

        if ($sortieForm->isSubmitted() && $sortieForm->isValid()){

            $sortie->setOrganisateur($this->getUser());

            if ($sortieForm->isSubmitted() && ($sortie->getDateLimiteInscription() > $sortie->getDateHeureDebut())){
                $etat = $em->getRepository(Etat::class)->findOneBy(['libelle' => 'Ouverte']);
                $sortie->setEtat($etat);
            };

            $em->persist($sortie);

            $em->flush();



            $this->addFlash('success','La sortie à bien été créée');
            return $this->redirectToRoute('main_home');
        }

        return $this->render("Sortie/ajout_sortie.html.twig", [
            'sortieForm' => $sortieForm,
            'lieu' => $lieu
        ]);
    }
    #[Route('/{id}/details/', name:'details_sortie', methods: ['GET','POST'])]
    public function details($id, SortieRepository $sortieRepo): Response{

        $sortie = $sortieRepo->find($id);
        return $this->render('Sortie/details_sortie.html.twig',
            [
                'sortie' => $sortie,
            ]);
    }

}