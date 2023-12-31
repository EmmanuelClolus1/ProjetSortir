<?php

namespace App\Controller;


use App\Entity\Etat;
use App\Entity\Participant;
use App\Entity\Sortie;
use App\Form\SortieType;
use App\Repository\CampusRepository;
use App\Repository\SortieRepository;
use App\Repository\VilleRepository;
use Doctrine\DBAL\Types\StringType;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\String_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/sortie')]
class SortieController extends AbstractController
{
    #[Route('/ajouter', name: 'ajouter_sortie', methods: ['GET','POST']) ]
    public function ajouterSortie(Request $request, EntityManagerInterface $em, CampusRepository $campusRepository): Response
    {
        $sortie = new Sortie();
        $sortieForm = $this->createForm(SortieType::class, $sortie);

        $sortieForm->handleRequest($request);

        if ($sortieForm->isSubmitted() && $sortieForm->isValid()){

            $sortie->setOrganisateur($this->getUser());


            $etat = $em->getRepository(Etat::class)->findOneBy(['libelle' => 'Ouverte']);
            $sortie->setEtat($etat);


            $em->persist($sortie);
            $em->flush();

            $this->addFlash('success','La sortie à bien été créée');
            return $this->redirectToRoute('main_home');
        }

        return $this->render("Sortie/ajout_sortie.html.twig", [
            'sortieForm' => $sortieForm,
        ]);
    }

    #[Route('/{id}/modifier', name: 'modifier_sortie', requirements: ['id' => '\d+'], methods: ['GET','POST']) ]
    public function modifierSortie(Request $request, EntityManagerInterface $em, Sortie $sortie): Response
    {

        if($this->getUser() == $sortie->getOrganisateur())
        {
            $sortieForm = $this->createForm(SortieType::class, $sortie);

            $sortieForm->handleRequest($request);

            if ($sortieForm->isSubmitted() && $sortieForm->isValid()){

                $sortie->setOrganisateur($this->getUser());


            $etat = $em->getRepository(Etat::class)->findOneBy(['libelle' => 'Ouverte']);
            $sortie->setEtat($etat);

                $em->persist($sortie);
                $em->flush();

                $this->addFlash('success','La sortie à bien été modifiée');
                return $this->redirectToRoute('details_sortie', ['id'=>$sortie->getId()]);
            }
        }
        else
        {
            $this->addFlash('warning', 'Vous ne pouvez pas modifier cette sortie');
            return $this->redirectToRoute('main_home');
        }

        return $this->render("Sortie/modifier_sortie.html.twig", [
            'sortieForm' => $sortieForm,
        ]);
    }

    #[Route('/{id}/details', name:'details_sortie', methods: ['GET','POST'])]
    public function details($id, SortieRepository $sortieRepo): Response{

        $sortie = $sortieRepo->find($id);
        return $this->render('Sortie/details_sortie.html.twig',
            [
                'sortie' => $sortie,
            ]);
    }

    #[Route('/{id}/inscription', name:'inscription_sortie',requirements: ['id' => '\d+'])]
    public function inscription(Sortie $sortie, EntityManagerInterface $em): Response{

        $user=$this->getUser();

        if ($sortie->getEtat()->getLibelle() == 'Ouverte'){
            if ((count($sortie->getParticipants())) < $sortie->getNbInscriptionMax() && !$sortie->getParticipant()->contains($this->getUser())){

                $sortie->addParticipant($user);

                $em->persist($sortie);
                $em->flush();

                $this->addFlash('success','Inscription à la sortie validée');
            }
            else{
                $this->addFlash('warning','Vous êtes déjà inscrit à cette sortie ou le nombre maximum d\'inscrit est atteint');
                return $this->redirectToRoute('main_home');
            }
        }else{
            $this->addFlash('warning','Il n\'est pas possible de de s\'inscrire à cette sortie' );
            return $this->redirectToRoute('main_home');
        }

        return $this->redirectToRoute('main_home');
    }

    #[Route('/{id}/desinscription', name:'desinscription_sortie',requirements: ['id' => '\d+'])]
    public function desinscription(Sortie $sortie, EntityManagerInterface $em): Response{

        $user=$this->getUser();

        $sortie->removeParticipant($user);

        $em->persist($sortie);
        $em->flush();

        $this->addFlash('success','Désinscription à la sortie validée');
        return $this->redirectToRoute('main_home');
    }


}