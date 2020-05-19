<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\PropertySearch;
use App\Entity\Proprietes;
use App\Form\ContactType;
use App\Form\PropertysearchType;
use App\Notification\ContactNotification;
use App\Repository\ProprietesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
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
    public function index(Request $request)
    {
        $search = new PropertySearch();
        $form = $this->createForm(PropertysearchType::class,$search);
        $form->handleRequest($request);

        $property= $this->repository->findAllvisible($search);

        return $this->render('property/index.html.twig', [
            'controller_name' => 'PropertyController',
            'currentMenu' => 'currentProprity',
            'proprieter' => $property,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("biens_{id}" , name="propertyshow")
     * @param $id
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function show($id,Request $request)
    {
        $contact = new Contact();
        $property = $this->repository->find($id);
        $contact->setProprietes($property);
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);
        /* if ($form->isSubmitted() && $form->isValid())
       {

       $this->addFlash('success','Votre message a ete envoyer');

       return $this->redirectToRoute('propertyshow',[
           'id' => $property->getId(),
       ]);
        }*/
        $property1= $this->repository->findAll();
        return $this->render('property/show.html.twig',[
            'property'=> $property,
            'propriter' => $property1,
            'currentMenu' => 'currentProprity',
            'form' => $form->createView()
        ]);
    }
}
