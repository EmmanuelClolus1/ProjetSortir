<?php

namespace App\Controller;

use App\Entity\Participant;
use App\Repository\ParticipantRepository;
use App\Repository\SortieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'main_home')]
    public function home(SortieRepository $sortieRepo): Response
    {
        $sorties = $sortieRepo->findAll();
        return $this->render('main/home.html.twig',
        [
            'sorties' => $sorties,
        ]);


    }
    #[Route('/profil/{id}/afficher', name: 'afficher_profil',requirements: ['id' => '\d+'], methods: ['GET'])]
    public function afficher(int $id,ParticipantRepository $participantRepository, Participant $participant): Response
    {
       // $participant = $participantRepository->find($id);

//        if(!$participant){
//            throw $this->createNotFoundException('profil inconnu');
//        }
        dump($participant);
        return $this->render('profil/afficher.html.twig', [
            'participant' => $participant
        ]);
    }
}
