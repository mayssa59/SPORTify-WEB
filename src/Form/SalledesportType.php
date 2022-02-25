<?php

namespace App\Form;

use App\Entity\Salledesport;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SalledesportType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('idSalle',TextType::class, array(
        'label' => 'Vorname ',
        'attr' => array(
            'placeholder' => 'Reference'
        )
    ))
            ->add('nomSalle',TextType::class, array(
                'label' => 'Vorname ',
                'attr' => array(
                    'placeholder' => 'Nom'
                )
            ))
            ->add('adresse',TextType::class, array(
                'label' => 'Vorname ',
                'attr' => array(
                    'placeholder' => 'Adresse'
                )
            ))
            ->add('hdebut',TextType::class, array(
                'label' => 'Vorname ',
                'attr' => array(
                    'placeholder' => 'Heure Début'
                )
            ))
            ->add('hfin',TextType::class, array(
                'label' => 'Vorname ',
                'attr' => array(
                    'placeholder' => 'Heure Fin'
                )
            ))
            ->add('min',TextType::class, array(
                'label' => 'Vorname ',
                'attr' => array(
                    'placeholder' => 'Min'
                )
            ))
            ->add('numtel',TextType::class, array(
                'label' => 'Vorname ',
                'attr' => array(
                    'placeholder' => 'N°Tel'
                )
            ))
            ->add('region')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Salledesport::class,
        ]);
    }
}
