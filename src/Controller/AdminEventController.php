<?php

namespace App\Controller;


use App\Entity\Evenement;
use App\Entity\User;
use App\Form\EventType;
use App\Repository\EvenementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AdminEventController
 * @package App\Controller
 */
class AdminEventController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private $manager;
    /**
     * @var EvenementRepository
     */
    private $eventRepository;

    /**
     * AdminEventController constructor.
     * @param EntityManagerInterface $manager
     * @param EvenementRepository $eventRepository
     */
    public function __construct(EntityManagerInterface $manager,EvenementRepository $eventRepository)
    {
        $this->manager = $manager;
        $this->eventRepository = $eventRepository;
    }

    /**
     * @Route("/event" , name="event.list")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $event = $this->eventRepository->findAll();
        return $this->render('adminproperty/Event/list.html.twig',[
            'events' => $event
        ]);
    }

    /**
     * @Route("/new_event_{id}" , name="event.new")
     * @param $id
     * @param Request $request
     * @param User $user
     * @return RedirectResponse|Response
     */
    public function new($id,Request $request,User $user)
    {
        $event = new Evenement();
        $form = $this->createForm(EventType::class,$event);
        $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid())
            {
                $event->setIduser($user);
                $this->manager->persist($event);
                $this->manager->flush();
                $this->addFlash('success' , 'Creer  avec success');

                return $this->redirectToRoute('event.list');
            }
        return $this->render('adminproperty/Event/new.html.twig',[
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/event_edit_{id}" , name="event.edit")
     * @param Evenement $evenement
     */
    public function edit(Evenement $evenement,Request $request)
    {
       $form = $this->createForm(EventType::class,$evenement);
       $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $this->manager->persist($evenement);
            $this->addFlash('success' , 'Modifier avec success');

            return $this->redirectToRoute('event.list');
        }

        return  $this->render('adminproperty/Event/new.html.twig',[
                'form' => $form->createView()
            ]);
    }

    /**
     * @Route("/event_delete_{id}" , name="event.delete")
     * @param Evenement $evenement
     * @return RedirectResponse
     */
    public  function delete(Evenement $evenement)
    {
        $this->manager->remove($evenement);
        $this->manager->flush();
        $this->addFlash('success' , 'supprimer  avec success');

        return $this->redirectToRoute('event.list');

    }
}