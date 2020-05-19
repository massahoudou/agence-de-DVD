<?php
namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\Extension\Core\Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('nom', Type\TextType::class)
            ->add('prenom', Type\TextType::class)
            ->add('telephone', Type\TextType::class)
            ->add('email', Type\EmailType::class)
            ->add('message', Type\TextareaType::class)

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }

}
