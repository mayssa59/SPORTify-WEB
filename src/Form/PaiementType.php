<?php

namespace App\Form;

use App\Entity\Paiement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use App\Entity\ModePaiement;
use App\Entity\Utilisateur;

class PaiementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Utilisateur',EntityType::class,array('label'=>'Adhérant', 'class' => Utilisateur::class, 'choice_label' => 'nom', 'multiple' => false))
            ->add('ModePaiement',EntityType::class,array('label'=>'Mode de paiement', 'class' => ModePaiement::class, 'choice_label' => 'libelle', 'multiple' => false))
            ->add('duree',ChoiceType::class, [
            'label' => 'Durée de l\'abonnement',
            'choices' => [
                '1 mois' => '1',
                '3 mois' => '3',
                '6 mois' => '6',
                '12 mois' => '12'
            ],
            'expanded' => true,
            'multiple' => false,
            //'empty_data' => 'total' //comment or uncomment this line don't change anything
        ])
            ->add('ajouter',SubmitType::class)        
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Paiement::class,
        ]);
    }
}
