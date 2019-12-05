<?php

namespace App\Form;

use App\Entity\Inscription;
use App\Entity\Payment;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InscriptionClubType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $options;
        $builder
            ->add('firstname', TextType::class)
            ->add('lastname', TextType::class)
            ->add('mail', EmailType::class)
            ->add('homePhone', TelType::class)
            ->add('mobilePhone', TelType::class)
            ->add('birthday', BirthdayType::class)
            ->add('address', TextType::class)
            ->add('zipCode', TextType::class)
            ->add('city', TextType::class)
            ->add('comment', TextareaType::class)
            ->add('createdAt', DateType::class)
            ->add('level', TextType::class)
            ->add('inscriptionYear', EntityType::class, [
                'class' => Inscription::class,
                'label' => 'inscription_year', ])
            ->add('inscription', EntityType::class, [
                'class' => Inscription::class,
                'label' => 'image_right'])
            ->add('payment', EntityType::class, [
                'class' => Payment::class,
                'label' => 'insurance'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => null,
        ]);
    }
}
