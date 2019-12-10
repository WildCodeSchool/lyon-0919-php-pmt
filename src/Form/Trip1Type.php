<?php

namespace App\Form;

use App\Entity\Trip;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Trip1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $options = $options; // Avoid PhpMd warning
        $builder
            ->add('price')
            ->add('dateStart', DateType::class, [
                'format' => 'dd-MM-yyyy',
            ])
            ->add('dateEnd', DateType::class, [
                'format' => 'dd-MM-yyyy',
            ])
            ->add('nbDiver')
            ->add('nbMonitor')
            ->add('description')
            ->add('location')
            ->add('name')
            ->add('typeTrip', null, ['choice_label' => 'name']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Trip::class,
        ]);
    }
}
