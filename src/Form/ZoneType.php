<?php

namespace App\Form;

use App\Entity\Zone;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ZoneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('region',TextType::class, array(
                'label' => 'Vorname ',
                'attr' => array(
                    'placeholder' => 'Région'
                )
            ))
            ->add('lng',TextType::class, array(
                'label' => 'Vorname ',
                'attr' => array(
                    'placeholder' => 'Longitude'
                )
            ))
            ->add('lat',TextType::class, array(
                'label' => 'Vorname ',
                'attr' => array(
                    'placeholder' => 'Latitude'
                )
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Zone::class,
        ]);
    }
}
