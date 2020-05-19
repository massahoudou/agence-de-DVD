<?php

namespace App\Controller;

use App\Entity\Categori;
use App\Form\CategoriType;
use App\Repository\CategoriRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/categori")
 */
class AdminCategoriController extends AbstractController
{
    /**
     * @Route("/", name="categori.index", methods={"GET"})
     */
    public function index(CategoriRepository $categoriRepository): Response
    {
        return $this->render('adminproperty/categori/index.html.twig', [
            'categoris' => $categoriRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="categori.new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $categori = new Categori();
        $form = $this->createForm(CategoriType::class, $categori);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($categori);
            $entityManager->flush();

            return $this->redirectToRoute('categori.index');
        }

        return $this->render('adminproperty/categori/new.html.twig', [
            'categori' => $categori,
            'form' => $form->createView(),
        ]);
    }



    /**
     * @Route("/{id}/edit", name="categori.edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Categori $categori): Response
    {
        $form = $this->createForm(CategoriType::class, $categori);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('categori.index');
        }

        return $this->render('adminproperty/categori/edit.html.twig', [
            'categori' => $categori,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="categori.delete", methods={"DELETE"})
     */
    public function delete(Request $request, Categori $categori): Response
    {
        if ($this->isCsrfTokenValid('delete'.$categori->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($categori);
            $entityManager->flush();
        }

        return $this->redirectToRoute('categori.index');
    }
}
