<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class RolesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('fullName')
            // ->add('email')
            ->add('roles', ChoiceType::class, [
                'choices' => [
                    'Membre' => 'ROLE_USER',
                    'Admin' => 'ROLE_ADMIN'
                ],
                'expanded' => true,
                'multiple' => true,
            ])
            // ->add('password')
            // ->add('pseudo')
            // ->add('gender')
            // ->add('createdAt')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
