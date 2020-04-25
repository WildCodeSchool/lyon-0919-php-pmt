<?php

namespace App\Form;

use App\Entity\Inscription;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class InscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $options;
        $builder
//            ->add('status')
            ->add('inscriptionYear')
//            ->add('user')

            ->add('internalProcedure', FileType::class, [
                'label' => 'Règlement intérieur',
                'attr' => ['placeholder' => 'Règlement intérieur (PDF)'],
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'application/pdf',
                            'application/x-pdf',
                        ],
                        'mimeTypesMessage' => 'Le document doit être au format PDF',
                    ])
                ]])
            ->add('medicalCertificate', FileType::class, [
                'label' => 'Certificat Médical',
                'attr' => ['placeholder' => 'Certificat Médical (PDF)'],
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'application/pdf',
                            'application/x-pdf',
                        ],
                        'mimeTypesMessage' => 'Le document doit être au format PDF',
                    ])
                ]])
            ->add('inscriptionSheet', FileType::class, [
                'label' => 'Formulaire d\'inscription',
                'attr' => ['placeholder' => 'Formulaire d\'inscription (PDF)'],
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'application/pdf',
                            'application/x-pdf',
                        ],
                        'mimeTypesMessage' => 'Le document doit être au format PDF',
                    ])
                ]])

            ->add('imageRight', FileType::class, [
                'label' => 'Droits d\'image',
                'attr' => ['placeholder' => 'Droits d\'image (PDF)'],
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'application/pdf',
                            'application/x-pdf',
                        ],
                        'mimeTypesMessage' => 'Le document doit être au format PDF',
                    ])
                ]])
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
