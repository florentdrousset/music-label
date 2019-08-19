<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nickname')
            ->add('password', null, [
                'required' =>true
            ])
            ->add('role')
            ->add('firstName')
            ->add('lastName')
            ->add('mail')
            ->add('address')
            ->add('zipCode')
            ->add('city')
            ->add('phone')
            ->add('collection')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
