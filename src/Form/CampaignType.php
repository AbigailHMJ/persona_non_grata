<?php

namespace App\Form;

use App\Entity\Campaign;
use App\Entity\Genres;
use App\Entity\Share;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CampaignType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('genre', EntityType::class, [
                'class' => Genres::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('shared', EntityType::class, [
                'class' => Share::class,
                'choice_label' => 'id',
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
