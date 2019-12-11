<?php

namespace App\Form;

use App\Entity\Level;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $options = $options; // Avoid PhpMd warning
        $builder
            ->add('firstname')
            ->add('lastname')
            ->add('email')
            ->add('homePhone')
            ->add('mobilePhone')
            ->add('birthday')
            ->add('address')
            ->add('zipCode')
            ->add('city')
            ->add('comment')
            ->add('picture')
            ->add('createdAt')
            ->add('updateAt')
            ->add('isAdmin')
            ->add('isMonitor')
            ->add('isSwim')
            ->add('isDiver')
            ->add('isHandi')
            ->add('level', EntityType::class, [
                'class' => Level::class,
                'choice_label' => 'name',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
