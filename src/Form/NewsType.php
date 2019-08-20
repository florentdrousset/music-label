<?php

namespace App\Form;

use App\Entity\News;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\User;

class NewsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('thematic')
            ->add('content')
            ->add('date_published')
            ->add('customer_id')
            ->add('customers')
            ->add('users', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'firstName'
            ])
            ->add('usersId', EntityType::class, [
                'class' =>  User::class,
                'choice_label' => 'lastName'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => News::class,
        ]);
    }
}
