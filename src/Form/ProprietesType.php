<?php

namespace App\Form;

use App\Entity\Categori;
use App\Entity\Proprietes;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProprietesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre',null,[
                'label'=>'Titre du DVD :'
            ])
            ->add('Categoris' , EntityType::class,[
                'class' => Categori::class,
                'choice_label' => 'nom',
                'multiple' => true
                ])
            ->add('acteurs', null ,[
                'label'=>'Les acteu du film :'
                      ])
            ->add('description',null ,[
                'label'=>'Description du film :'
            ])
            ->add('prix',null ,[
                'label'=>'Prix du film :'
            ])
            ->add('origine',null ,[
                'label'=>'Origine du film :'
            ])
            ->add('realisateur',null ,[
                'label'=>'Réalisateur du film :'
            ])
            ->add('datesorti_at',null ,[
                'label'=>'Date de sorti du film :'
            ])
            ->add('producteur',null ,[
                'label'=>'Producteur du film :'
            ])
            ->add('imagefile',FileType::class,[
                'required' => true

            ])
            ->add('solde')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Proprietes::class,
        ]);
    }
}
