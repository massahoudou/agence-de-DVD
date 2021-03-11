<?php

namespace App\Controller;

use App\Entity\Message;
use App\Entity\Reservation;
use App\Repository\MessageRepository;
use App\Repository\ReservationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;   

class ContactController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager ;
    }

    /**
     * @Route("/contact" ,name="contact.list")
     * @param MessageRepository $messageRepository
     * @return Response
     */
    public function contact(MessageRepository $messageRepository)
    {
        $message = $messageRepository->findAll();

        return $this->render('adminproperty/message.hml.twig',[
            'messages' =>  $message
        ]);
    }

    /**
     * @Route("/contactdelete_{id}",name="contact.delete")
     * @param Message $message
     * @param RedirectResponse
     */
    public function Contactdelete(Message $message)
    {
        $this->manager->remove($message);
        $this->manager->flush();
        $this->addFlash('success' , 'supprimer  avec success');
        return $this->redirectToRoute('contact.list');
    }

    /**
     * @Route("/reservation" , name="reservation.list")
     *  @param ReservationRepository $reservation
     * @return Response
     */
    public function reservationList(ReservationRepository $reservation)
    {
        $reservation = $reservation->findAll();
     
        return $this->render('adminproperty/reservation.html.twig',[
            'reservations' => $reservation
        ]);
    }

    /**
     * @Route("/reservationdelete_{id}" , name="reservation.delete" )
     * @param Request $request
     * @param Reservation $reservation
     * @return Response
     */
    public function reservationdelete(Request $request,Reservation $reservation):Response
    {
        $this->manager->remove($reservation);
        $this->manager->flush();
        $this->addFlash('success' , 'supprimer  avec success');

        return $this->redirectToRoute('reservation.list');
    }

    
}
