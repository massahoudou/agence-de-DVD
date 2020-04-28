<?php

namespace App\Controller;

use App\Entity\Categori;
use App\Entity\Proprietes;
use App\Form\ProprietesType;
use App\Repository\ProprietesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminpropertyController extends AbstractController
{
    /**
     * AdminpropertyController constructor.
     * @param ProprietesRepository $repository
     */
    public function __construct(ProprietesRepository $repository,EntityManagerInterface $manager)
    {
        $this->repository = $repository;
        $this->manager = $manager;
    }

    /**
     * @Route("/admin", name="adminhome ")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $proprietes = $this->repository->findAll();
        return $this->render('adminproperty/index.html.twig', [
            'controller_name' => 'AdminpropertyController',
            'proprieter'=>$proprietes
        ]);
    }

    /**
     *@Route("/acceuil", name="acceuil ")
     * @return Response
     */
    public function acceuil()
    {
        return $this->render('adminproperty/home.html.twig');
    }

    /**
     * @Route("/adminnew", name="adminnew ")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function new(Request $request)
    {
        $proprietes = new proprietes();
        $form = $this->createForm(ProprietesType::class,$proprietes);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
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
     * @return \Symfony\Component\HttpFoundation\Response
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
     */
    public function delete(Proprietes $proprietes , Request $request)
    {
            $this->manager->remove($proprietes);
            $this->manager->flush();
        $this->addFlash('success' , 'supprimer  avec success');

        return $this->redirectToRoute('adminhome ');
    }
}
