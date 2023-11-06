<?php

namespace App\Controller;

use App\Form\FilterModelType;
use App\Form\Model\FilterModel;
use App\Repository\SortieRepository;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'main_home')]
    public function home(SortieRepository $sortieRepo, Request $request): Response
    {

        $filterModel = new FilterModel();
        $form = $this->createForm(FilterModelType::class, $filterModel);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
           $filterModel->setSortiePassées($this->getUser());
            }
            $sorties = $sortieRepo->findAll();
            return $this->render('main/home.html.twig',
                [
                    'sorties' => $sorties,
                ]);


        }
    }