<?php

namespace App\Form;

use App\Entity\Campaign;
use App\Entity\Genres;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CampaignType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre : ',
                'attr' => [
                    'placeholder' => 'nom de la campagne',
                ]
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description : ',
                'attr' => [
                    'placeholder' => 'Brève description de l\'univers'
                ]
            ])
            ->add('genres', EntityType::class, [
                'class' => Genres::class,
                'choice_label' => 'keyword',
                'label' => 'Genres : ',
                'multiple' => true,
                'expanded' => true,
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Campaign::class,
        ]);
    }
}
