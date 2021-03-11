<?php

namespace App\Controller;

use App\Entity\Message;
use App\Entity\PropertySearch;
use App\Entity\Proprietes;
use App\Entity\User;
use App\Form\MessageType;
use App\Form\PropertysearchType;
use App\Repository\EvenementRepository;
use App\Repository\MessageRepository;
use App\Repository\ProprietesRepository;
use App\Repository\UserRepository;
use DateTime;

;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    /**
     * @var ProprietesRepository
     */
    private $repository;
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(ProprietesRepository $repository,EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->repository = $repository;
    }

    /**
     * @Route("/home", name="index")
     * @param ProprietesRepository $repositor
     * @return Response
     */
    public function index(ProprietesRepository $repositor)
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * @Route("/",name="home")
     * @param Request $request
     * @param EvenementRepository $evenementRepository
     * @return Response
     */
    public function home(Request $request,EvenementRepository $evenementRepository)
    {
        $search = new PropertySearch();
        $form = $this->createForm(PropertysearchType::class,$search);
        $form->handleRequest($request);
        $event = $evenementRepository->findEvent();
        $proprieter = $this->repository->findLatest($search);
        return $this->render('home/home.html.twig',[
            'proprieter' => $proprieter,
            'form' => $form->createView(),
            'events' => $event
        ]);
    }

    /**
     * @param ProprietesRepository $repository
     * @param Request $request
     * @return Response
     */
    public function search(ProprietesRepository $repository, Request $request)
    {
        $proprieter = $repository->findLatest();
        return $this->render('home/home.html.twig',[
            'proprieter' => $proprieter,
        ]);
    }

    /**
     * @Route("/avis_{id}", name="contact")
     * @param  $id
     * @param Request $request
     * @param MessageRepository $messageRepository
     * @param User $user
     * @return RedirectResponse|Response
     */
    public function message($id,Request $request,MessageRepository $messageRepository,UserRepository $userRepository)
    {
        $message = new Message();
        $form = $this->createForm(MessageType::class,$message);
        $form->handleRequest($request);
        $user = $userRepository->find($id);

        
        if( $form->isSubmitted() && $form->isValid())
        {
            $message->setIduser($user);
            $message->setDate(new DateTime());
            $this->em->persist($message);
            $this->em->flush();
            $this->addFlash('aleet','Votre message a bien été partagé');
            return $this->redirectToRoute('contact',[
                'id' => $user->getId()
            ]);
        }

        return $this->render('home/message.html.twig' ,[
            'form' => $form->createView()
        ]);
    }

}
