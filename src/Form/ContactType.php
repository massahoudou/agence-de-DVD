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
        ->add('nom', Type\TextType::class,[
            'required' => true
        ])
            ->add('prenom', Type\TextType::class,[
                'required' => true
            ])
            ->add('telephone', Type\TextType::class,[
                'required' => true
            ])
            ->add('email', Type\EmailType::class,[
                'required' => true
            ])
            ->add('message', Type\TextareaType::class,[
                'required' => false,
                'label' => 'Méssage ( __facultatif__)'
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }

}
