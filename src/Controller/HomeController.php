<?php

namespace App\Controller;

use App\Entity\PropertySearch;
use App\Form\PropertysearchType;
use App\Repository\ProprietesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="index")
     */
    public function index(ProprietesRepository $repositor)
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * @Route("/",name="home")
     * @param ProprietesRepository $repository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function home(ProprietesRepository $repository,Request $request)
    {
        $search = new PropertySearch();
        $form = $this->createForm(PropertysearchType::class,$search);
        $form->handleRequest($request);
        $proprieter = $repository->findLatest($search);
        return $this->render('home/home.html.twig',[
            'proprieter' => $proprieter,
            'form' => $form->createView()
        ]);
    }
    public function search(ProprietesRepository $repository, Request $request)
    {
        $proprieter = $repository->findLatest();
        return $this->render('home/home.html.twig',[
            'proprieter' => $proprieter,
        ]);
    }
}
