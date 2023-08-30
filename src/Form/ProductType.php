<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('description', TextareaType::class, [
                'label' => 'Description du produit',
                // 'label_attr' => [
                //     'class' => 'form-label mt-4'
                // ],
            ])
            ->add('color')
            ->add('size')
            ->add('collection', ChoiceType::class, [
                'choices'  => [
                    'Homme' => 'Men',
                    'Femme' => 'Women',
                ],
            ])
            ->add('image')
            ->add('price')
            ->add('stock')
            // ->add('createdAt')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
