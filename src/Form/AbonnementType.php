<?php

namespace App\Form;

use App\Entity\Abonnement;
use App\Entity\Utilisateur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AbonnementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('typeAbonnement' ,ChoiceType::class, [
                'choices' => [
                    'Mensuelle' => 'Mensuelle',
                    'Annuel' => 'Annuel',
                    'Trimestriel' => 'Trimestriel',
                    'Semestriel ' => 'Semestriel',
                ],
            ])

            ->add('prixAbonnement')
            ->add('datecreation')
            ->add('surnomUser',EntityType::class,[
                    'class'=>Utilisateur::class,
                    'choice_label'=>'surnom','empty_data' => '',
                ]
            )
        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Abonnement::class,
        ]);
    }
}
