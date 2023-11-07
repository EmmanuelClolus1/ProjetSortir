<?php

namespace App\Controller;

use App\Entity\Participant;
use App\Form\ParticipantType;
use App\Form\RegistrationFormType;
use App\Repository\ParticipantRepository;
use App\Services\FileUploader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class ProfilController extends AbstractController
{
    #[Route('/profil/{id}', name: 'mon_profil',requirements: ['id' => '\d+'], methods: ['GET'])]
    public function profil(int $id,ParticipantRepository $participantRepository): Response
    {
        $participant = $participantRepository->find($id);

        if(!$participant){
            throw $this->createNotFoundException('profil inconnu');
        }

        return $this->render('profil/profil.html.twig', [
            'participant' => $participant
        ]);
    }
    #[Route('/profil/{id}/modifier', name: 'modifier_profil', requirements: ['id' => '\d+'], methods: ['GET', 'POST'])]
    public function modifier(FileUploader $fileUploader, Request $request,Participant $participant,EntityManagerInterface $em,UserPasswordHasherInterface $userPasswordHasher):Response
    {
        $participantForm=$this->createForm(ParticipantType::class,$participant);
        $participantForm->handleRequest($request);

        if ($participantForm->isSubmitted() && $participantForm->isValid()){
            $participant->setPassword(
                $userPasswordHasher->hashPassword(
                    $participant,
                    $participantForm->get('plainPassword')->getData()
                ));
            $imageFile = $participantForm->get('image')->getData();
            if ($imageFile){
                $participant->setFilename($fileUploader->upload($imageFile));
            }
            $em->persist($participant);
            $em->flush();
            $this->addFlash('success', 'Le profil a été modifié');
            return $this->redirectToRoute('mon_profil', ['id' => $participant->getId()]);
        }
        return $this->render('profil/modifier.html.twig',['ParticipantForm'=>$participantForm]);
    }
    #[Route('/profil/{id}/afficher', name: 'afficher_profil',requirements: ['id' => '\d+'], methods: ['GET'])]
    public function afficher(int $id,ParticipantRepository $participantRepository, Participant $participant): Response
    {
        $participant = $participantRepository->find($id);

        if(!$participant){
            throw $this->createNotFoundException('profil inconnu');
        }

        return $this->render('profil/afficher.html.twig', [
            'participant' => $participant
        ]);
    }

}
