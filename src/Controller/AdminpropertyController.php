<?php

namespace App\Controller;

use App\Entity\Categori;
use App\Entity\Message;
use App\Entity\Proprietes;
use App\Form\ProprietesType;
use App\Repository\MessageRepository;
use App\Repository\ProprietesRepository;
use App\Entity\Reservation;
use App\Entity\User;
use App\Repository\ReservationRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminpropertyController extends AbstractController
{
    /**
     * @var ProprietesRepository
     */
    private $repository;
    /**
     * @var EntityManagerInterface
     */
    private $manager;

    /**
     * AdminpropertyController constructor.
     * @param ProprietesRepository $repository
     * @param EntityManagerInterface $manager
     */
    public function __construct(ProprietesRepository $repository,EntityManagerInterface $manager)
    {
        $this->repository = $repository;
        $this->manager = $manager;
    }

    /**
     * @Route("/admin", name="adminhome ")
     * @return Response
     */
    public function index(MessageRepository $message,ReservationRepository $reservation,UserRepository $user)
    {
        $dvd = $this->repository->countdvd();
        $reserv = $reservation->countreserv();
        $count = $message->countcontact();
        return $this->render('adminproperty/home.html.twig',[
            'message' => $count,
            'reservation' => $reserv,
            'dvd' => $dvd,
            'users' => $user->findAll()
        ]);
    }
    /**
     *@Route("/admin_dvd_list", name="acceuil")
     * @return Response
     */
    public function listdvd()
    {
        $proprietes = $this->repository->findAll();
        return $this->render('adminproperty/index.html.twig', [
            'controller_name' => 'AdminpropertyController',
            'proprieter'=>$proprietes
        ]);
    }

    /**
     * @Route("/adminnew_{id}", name="adminew")
     * @param $id
     * @param Request $request
     * @param User $user
     * @return RedirectResponse|Response
     */
    public function new($id,Request $request,User $user)
    {
        $proprietes = new proprietes();
        $form = $this->createForm(ProprietesType::class,$proprietes);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $proprietes->setIduser($user);
            $this->manager->persist($proprietes);
            $this->manager->flush();
            $this->addFlash('success' , 'Creer  avec success');
            return $this->redirectToRoute('adminhome ');
        }
            return $this->render('adminproperty/new.html.twig', [
                'proprity' => $proprietes,
                'form'=> $form->createView()]);

    }

    /**
     * @Route("/adminproperty_{id}" ,name="adminedit", methods="GET|POST")
     * @param Proprietes $proprietes
     * @param Request $request
     * @return Response
     */
    public function edit(Proprietes $proprietes,Request $request )
    {

        $form = $this->createForm(ProprietesType::class,$proprietes);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $this->manager->flush();
            $this->addFlash('success' , 'Modifeir  avec success');
            return $this->redirectToRoute('adminhome ');
        }
        return $this->render('adminproperty/edit.html.twig',[
            'proprity' => $proprietes,
            'form'=> $form->createView()
        ]);
    }

    /**
     * @Route("/admin_{id}" ,name="admindelete" )
     * @param Proprietes $proprietes
     * @param Request $request
     * @return RedirectResponse
     */
    public function delete(Proprietes $proprietes , Request $request)
    {
            $this->manager->remove($proprietes);
            $this->manager->flush();
        $this->addFlash('success' , 'supprimer  avec success');

        return $this->redirectToRoute('adminhome ');
    }




}
