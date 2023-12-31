<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('gender', ChoiceType::class, [
                'label' => 'Civilité',
                'choices'  => [
                    'Homme' => 'Men',
                    'Femme' => 'Women',
                ],
            ])

            ->add('pseudo',  TextType::class, [
                'label' => 'Pseudo (facultatif)',
            ])

            ->add('fullName')
            ->add('email')
            // ->add('roles', ChoiceType::class, [
            //     'choices' => [
            //         'Membre' => 'ROLE_USER',
            //         'Admin' => 'ROLE_ADMIN'
            //     ],
            //     'expanded' => true,
            //     'multiple' => true,
            // ])

            ->add('plainPassword', RepeatedType::class, [
                'type' =>  PasswordType::class,
                'first_options' => ['label' => 'mot de passe'],
                'second_options' => ['label' => 'confirmer le mot de passe'],
                'invalid_message' => "les mots de passes ne correspondent pas",
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrez un mot de passe non vide',
                    ]),
                    new Length([
                        'min' => 8,
                        'minMessage' => 'votre mot de passe est trop court',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                    new Regex([
                        'pattern' => '/^(?=.*[a-z])(?=.*\d)(?=.*[@$!%#*?&])[A-Za-z\d@$!%#*?&]{8,}$/',
                        'match' => true,
                        'message' => 'Votre mot de passe doit contenir au moins un chiffre, un caractère spécial (@$!%#*?&), une lettre minuscule et une majuscule!'
                    ]),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
