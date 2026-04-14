<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', TextType::class, [
                'label' => 'Nom d\'utilisateur : ',
                'required' => true,
                'attr' => [
                    'placeholder' => 'votre pseudonyme',
                ],
                'constraints' => [
                    new Length(
                        min:1,
                        minMessage: 'Votre nom d\'utilisateur doit contenir au minimum {{ limit }} caractère.',
                    ),
                ],
            ])
            ->add('email', EmailType::class, [
                'label' => 'Adresse mail : ',
                'required' => true,
                'attr' => [
                    'placeholder' => 'votre email',
                ]
            ])
            ->add('birthdate', DateType::class, [
                'label' => 'Date de naissance : ',
                'required' => true,
                'attr' => [
                    'placeholder' => 'JJ/MM/AAAA',
                ]
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'label' => ' ',
                'constraints' => [
                    new IsTrue(
                        message: 'Vous devez accepter les conditions d\'utilisation',
                    ),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'required' => true,
                'attr' => [
                    'autocomplete' => 'new-password',
                    'placeholder' => 'votre mot de passe'
                ],
                'constraints' => [
                    new NotBlank(
                        message: 'Merci de bien vouloir entrer un mot de passe',
                    ),
                    new Length(
                        min: 6,
                        minMessage: 'Votre mot de passe doit contenir au minimum {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        max: 4096,
                    ),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
