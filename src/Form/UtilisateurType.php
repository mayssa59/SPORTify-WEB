<?php

namespace App\Form;

use App\Entity\Utilisateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class UtilisateurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('surnom')
            ->add('prenom')
            ->add('nom')
            ->add('numerodetelephone')
            ->add('email')
            ->add('password')
            ->add('datedenaissance', DateType::class, [
                'widget' => 'choice',
                'years' => range(1920,2006)
            ])
            ->add('sexe', ChoiceType::class,array(
                'choices' => array(
                    'Homme' => 'Homme',
                    'Femme' => 'Femme',
                )
            ))
            ->add('role', ChoiceType::class,array(
                'choices' => array(
                    'Client' => 'Client',
                    'Coach' => 'Coach',
                    'Proprietaire salle de sport' => 'Proprietaire salle de sport',

                )
            ))

            ->add('image',FileType::class, [
                // unmapped means that this field is not associated to any entity property
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/*',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid Image document',
                    ])
                ],])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
        ]);
    }

}
