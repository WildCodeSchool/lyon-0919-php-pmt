<?php

namespace App\Form;

use App\Entity\Trip;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TripType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $options;
        $builder
            ->add('price')
            ->add('dateStart')
            ->add('nbDiver')
            ->add('nbMonitor')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('dateEnd')
            ->add('description')
            ->add('location')
            ->add('name')
            ->add('imageName')
            ->add('typeTrip')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Trip::class,
        ]);
    }
}
