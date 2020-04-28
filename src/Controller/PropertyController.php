<?php

namespace App\Controller;

use App\Entity\PropertySearch;
use App\Entity\Proprietes;
use App\Form\PropertysearchType;
use App\Repository\ProprietesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PropertyController extends AbstractController
{
    /**
     * @var ProprietesRepository
     */
    private $repository ;

    /**
     * PropertyController constructor.
     * @param ProprietesRepository $repository
     * @param ObjectManager $em
     */
    public function __construct(ProprietesRepository $repository,EntityManagerInterface $em)
    {

        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/biens", name="property.index")
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
     */
    public function show($id)
    {
        $property = $this->repository->find($id);
        return $this->render('property/show.html.twig',[
            'property'=> $property,
            'currentMenu' => 'currentProprity'
        ]);
    }
}
