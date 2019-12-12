<?php

namespace App\Form;

use App\Entity\Inscription;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $options;
        $builder
//            ->add('status')
//            ->add('internalProcedure')
//            ->add('medicalCertificate')
//            ->add('inscriptionSheet')
            ->add('inscriptionYear')
//            ->add('imageRight')
//            ->add('user')
//            ->add('inscriptionStatus')
//            ->add('insurance')
//            ->add('adhesionPrice')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Inscription::class,
        ]);
    }
}
