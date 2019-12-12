<?php

namespace App\Form;

use App\Entity\Trip;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class Trip1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $options;
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
            ->add('typeTrip', null, ['choice_label' => 'name'])
            ->add('imageFile', FileType::class, [
                'label' => 'Image',
                'mapped'=>false,
                'required'=>false,
                'constraints'=>[
                    new File([
                        'maxSize'=>'2000k',
                    ])
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Trip::class,
        ]);
    }
}
