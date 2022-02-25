<?php

namespace App\Form;

use App\Entity\Evennement;
use App\Entity\Salledesport;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EvennementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomEvennement')
            ->add('nbplaces')
            ->add('description')
            ->add('date')
            ->add('nomSalle',EntityType::class,[
                'class'=>Salledesport::class,
                'choice_label'=>'nomSalle',
            ])
        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Evennement::class,
        ]);
    }
}
