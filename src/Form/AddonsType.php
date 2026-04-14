<?php

namespace App\Form;

use App\Entity\Addons;
use App\Entity\Character;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddonsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('playlist', TextType::class, [
                'label' => 'Playlist : ',
                'required' => false,
                'attr' => [
                    'placeholder' => 'lien de la playlist de votre personnage',
                ],
            ])
            ->add('moodboard', TextType::class, [
                'label' => 'Moodboard : ',
                'required' => false,
                'attr' => [
                    'placeholder' => 'lien du moodboard/tableau pinterest de votre personnage',
                ],
            ])
            ->add('other', TextType::class, [
                'label' => 'Autre : ',
                'required' => false,
                'attr' => [
                    'placeholder' => 'lien vers un autre élément concernant votre personnage',
                ],
            ])
            ->add('addon', EntityType::class, [
                'class' => Character::class,
                'choice_label' => 'name',
                'label' => 'Personnage : ',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Addons::class,
        ]);
    }
}
