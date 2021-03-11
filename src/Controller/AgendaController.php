<?php

namespace App\Controller;

use App\Repository\EvenementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AgendaController extends AbstractController
{
    /**
     * @Route("/agenda", name="agenda")
     * @param EvenementRepository $evenementRepository
     * @return Response
     */
    public function index(EvenementRepository $evenementRepository)
    {
        $event = $evenementRepository->findAll1();
        return $this->render('agenda/index.html.twig', [
            'controller_name' => 'AgendaController',
            'currentMenu' => 'currentAgenda',
            'events' => $event
        ]);
    }
}
