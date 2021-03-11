<?php
namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Form\UserFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;




class UserController extends AbstractController
{
    /**
     * @Route("/admin/user_edit_{id}",name="user.edit")
     */
    public function Useredit(User $user,Request $request)
    {
        $form = $this->createForm(RegistrationFormType::class,$user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success' , 'Modifier  avec success');
            return $this->redirectToRoute('acceuil');
        }
        return $this->render('registration/registerad.html.twig',[
            'user' => $user,
            'Form'=> $form->createView()
        ]);
    }
    /**
     * @Route("/admin/user_delete_{id}",name="user.delete")
     */
    public function userdelete(User $user)
    {
        $this->getDoctrine()->getManager()->remove($user);
        $this->getDoctrine()->getManager()->flush();
        $this->addFlash('success' , 'supprimer  avec success');
       
        return $this->redirectToRoute('acceuil');
    }
    /**
     * @Route("/admin/user_new",name="user.new")
     */
    public function Usernew(Request $request)
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class,$user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $this->getDoctrine()->getManager()->persist($user);
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success' , 'enregistrer  avec success');
            return $this->redirectToRoute('acceuil');
        }
        return $this->render('registration/registerad.html.twig',[
            'user' => $user,
            'Form'=> $form->createView()
        ]);
    }
    /**
     * @Route("/profile_{id}", name="profile.edit")
     */
    public function Useredit2(User $user,Request $request)
    {
        $form = $this->createForm(UserFormType::class,$user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {   dd($user);
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success' , 'Modifier  avec success');
            return $this->redirectToRoute('home');
        }
        return $this->render('registration/register.html.twig',[
            'user' => $user,
            'registrationForm'=> $form->createView()
        ]);
    }

    /**
     * @Route("/profile_delete_{id}",name="profile.delete")
     * @param $id
     * @param User $user
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function userdelete2($id,User $user)
    {
        $this->getDoctrine()->getManager()->remove($user);
        $this->getDoctrine()->getManager()->flush();
        $this->addFlash('success' , 'supprimer  avec success');
        return $this->redirectToRoute('home');
    }
}