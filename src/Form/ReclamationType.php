<?php

namespace App\Form;

use App\Entity\Reclamation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

use App\Entity\Naturereclam;
use App\Entity\Utilisateur;

class ReclamationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            
            ->add('datereclam',DateType::class,['label'=>'date de reclamation','years' => range(1990,2030),'months'=> range(1,12),'widget' => 'single_text'])
            ->add('Naturereclam',EntityType::class,array('label'=>'Concernant', 'class' => Naturereclam::class, 'choice_label' => 'objet', 'multiple' => false))
            ->add('Utilisateur',EntityType::class,array('label'=>'Adhérant', 'class' => Utilisateur::class, 'choice_label' => 'surnom', 'multiple' => false))
            ->add('message',TextareaType::class)
            ->add('ajouter',SubmitType::class)
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Reclamation::class,
        ]);
    }
}
