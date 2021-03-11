<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\User;
use App\Entity\PropertySearch;
use App\Entity\Proprietes;
use App\Entity\Reservation;
use App\Form\PropertysearchType;
use App\Form\ReservationType;
use App\Notification\ContactNotification;
use App\Repository\EvenementRepository;
use App\Repository\ProprietesRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PropertyController extends AbstractController
{
    /**
     * @var ProprietesRepository
     */
    private $repository ;
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * PropertyController constructor.
     * @param ProprietesRepository $repository
     * @param EntityManagerInterface $em
     */
    public function __construct(ProprietesRepository $repository,EntityManagerInterface $em)
    {

        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/biens", name="property.index")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request,EvenementRepository $evenementRepository)
    {

        $search = new PropertySearch();
        $form = $this->createForm(PropertysearchType::class,$search);
        $form->handleRequest($request);
        $events = $evenementRepository->findEvent();
        $property= $this->repository->findAllvisible($search);

        return $this->render('property/index.html.twig', [
            'controller_name' => 'PropertyController',
            'currentMenu' => 'currentProprity',
            'proprieter' => $property,
            'form' => $form->createView(),
            'events' => $events
        ]);
    }


    /**
     * @Route("biens_{id}_{user}" , name="propertyshow")
     * @param $id
     * @param Request $request
     * @param User $user
     * @return RedirectResponse|Response
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function show($id, Request $request, User $user)
    {

        $property = $this->repository->find($id);
        $reservation = new Reservation();
       
       
        $form = $this->createForm(ReservationType::class,$reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
       {
            $reservation->setIduser($user);
            $reservation->setIdproduit($property);
           $this->em->persist($reservation);
           $this->em->flush();
           $this->addFlash('success','Votre Reservation a été enregistrer ');
           return $this->redirectToRoute('propertyshow',[
               'id' => $property->getId(),
               'user'=>$user->getId()
       ]);
        }
        $property1= $this->repository->findAll();
        return $this->render('property/show.html.twig',[
            'property'=> $property,
            'propriter' => $property1,
            'currentMenu' => 'currentProprity',
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("topfilm" , name="topfilm")
     * @param EvenementRepository $evenementRepository
     * @return Response
     */
    public function topfilm(EvenementRepository $evenementRepository)
    {
        $events = $evenementRepository->findEvent();
        $property= $this->repository->findTop();

        return $this->render('property/topfilm.html.twig', [
            'controller_name' => 'Topfilm',
            'currentMenu' => 'currentTopfilm',
            'proprieter' => $property,
            'events' => $events
        ]);
    }
    /**
     * @Route("/newfilm" , name="newfilm")
     * @param EvenementRepository $evenementRepository
     * @return Response
     */
    public function newfilm(EvenementRepository $evenementRepository)
    {
        $events = $evenementRepository->findEvent();
        $property= $this->repository->findnew();

        return $this->render('property/newfilm.html.twig', [
            'controller_name' => 'Topfilm',
            'currentMenu' => 'currentnewfilm',
            'proprieter' => $property,
            'events' => $events
        ]);
    }
}
