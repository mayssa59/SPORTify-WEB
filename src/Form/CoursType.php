<?php

namespace App\Form;

use App\Entity\Categories;
use App\Entity\Cours;
use App\Entity\Salledesport;
use App\Entity\Utilisateur;
use phpDocumentor\Reflection\Type;
use phpDocumentor\Reflection\TypeResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CoursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('idCours')
            ->add('typeCours',EntityType::class,[
                'class'=>Categories::class,
                'choice_label'=>'type',
                'empty_data' => '',

            ])
            ->add('date')
            ->add('heure')
            ->add('duree')
            ->add('mailcoach' ,EntityType::class,[
                    'class'=>Utilisateur::class,
                    'choice_label'=>'email','empty_data' => '',
                ]
            )
            ->add('placeDisponible')
            ->add('nomsalledesport' ,EntityType::class,[
                    'class'=>Salledesport::class,
                    'choice_label'=>'nomSalle','empty_data' => '',
                ]
            )



        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Cours::class,
        ]);
    }
}
