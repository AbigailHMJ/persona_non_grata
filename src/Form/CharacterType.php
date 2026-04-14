<?php

namespace App\Form;

use App\Entity\Character;
use App\Entity\Campaign;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Length;

class CharacterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'required' => true,
                // The form needs at least this field to not be empty
                'label' => 'Nom : ',
                'attr' => [
                    'placeholder' => 'le nom complet de votre personnage',
                ],
                'constraints' => [
                    new Length(
                        min:1,
                        // Minimum length is set to one to be accessible to languages like chinese or japanese
                        minMessage: 'Vous devez entrer au moins {{ limit }} caractère',
                    ),
                ],
            ])
            ->add('age', TextType::class, [
                'required' => false,
                'label' => 'Âge : ',
                'attr' => [
                    'placeholder' => 'l\'âge de votre personnage',
                ],
            ])
            ->add('physical_traits', TextareaType::class, [
                'required' => false,
                'label' => 'Traits physiques : ',
                'attr' => [
                    'placeholder' => 'courte description ou liste de traits physiques notables de votre personnage',
                ],
            ])
            ->add('character_traits', TextareaType::class, [
                'required' => false,
                'label' => 'Caractère : ',
                'attr' => [
                    'placeholder' => 'courte description ou liste de traits de caractère de votre personnage',
                ],
            ])
            ->add('background', TextareaType::class, [
                'required' => false,
                'label' => 'Histoire : ',
                'attr' => [
                    'placeholder' => 'histoire ou chronologie de votre personnage',
                ],
            ])
            ->add('others', TextareaType::class, [
                'required' => false,
                'label' => 'Autres : ',
                'attr' => [
                    'placeholder' => 'autres choses notables à propos de votre personnage (goûts, anecdotes...)',
                ],
            ])
            ->add('illustration', FileType::class, [
                'label' => 'Illustration : ',
                // Ensures that the field is not required to be filled to submit the form
                // Illustration is optional as per the Character entity
                'required' => false,
                'multiple' => false,
                // Defining mapped as false allows he use of constraints classes to check files
                'mapped' => false,
                'constraints' => [
                        new File(
                            maxSize: '10M',
                            mimeTypes: ['image/jpeg', 'image/png', 'image/webp', 'image/gif'],
                            mimeTypesMessage: 'Formats acceptés : jpeg, png, gif, webp',
                        ),
                ],
            ])
            ->add('campaign', EntityType::class, [
            'class' => Campaign::class,
            'choice_label' => 'title',
            'label' => 'Campagne :',
            // Adding character to a campaign is optional
            'required' => false,
            // Ensures no campaign is selected by default in the form
            'placeholder' => '-- Ajouter à une campagne (facultatif) --',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Character::class,
        ]);
    }
}
