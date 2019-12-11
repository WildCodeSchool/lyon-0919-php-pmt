<?php

namespace App\Form;

use App\Entity\AdhesionPrice;
use App\Entity\Document;
use App\Entity\Inscription;
use App\Entity\Insurance;
use App\Entity\Level;
use App\Entity\Payment;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
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
            ->add('homePhone', TelType::class, ['required' => false,])
            ->add('mobilePhone', TelType::class)
            ->add('birthday', BirthdayType::class)
            ->add('address', TextType::class)
            ->add('zipCode', TextType::class)
            ->add('city', TextType::class)
            ->add('comment', TextareaType::class, ['required' => false,])
            ->add('level', EntityType::class, [
                'class' => Level::class,
                'choice_label' => 'name',
                'expanded' => false,
                'multiple' => false,
                'by_reference' => false,
            ])
//            ->add('payment', EntityType::class, [
//                'class' => Payment::class,
//                'choice_label' => 'typePayment',
//                'expanded' => false,
//                'multiple' => false,
//                'by_reference' => false,
//            ])
            ->add('inscription', EntityType::class, [
                'class' => Inscription::class,
                'choice_label' => 'inscriptionYear',
                'expanded' => false,
                'multiple' => false,
                'by_reference' => false,
            ])
            ->add('document', EntityType::class, [
                'class' => Document::class,
                'choice_label' => 'name',
                'expanded' => true,
                'multiple' => true,
                'by_reference' => false,
            ])
            ->add('insurance', EntityType::class, [
                'class' => Insurance::class,
                'choice_label' =>  function ($insurance) {
                    /** @var Insurance $insurance */
                    return $insurance->getName() . ' : ' . $insurance->getPrice() . " €";
                },
                'expanded' => false,
                'multiple' => false,
                'by_reference' => true,
            ])
            ->add('adhesion', EntityType::class, [
                'class' => AdhesionPrice::class,
                'choice_label' => function ($adhesion) {
                    /** @var AdhesionPrice $adhesion */
                    return $adhesion->getName() . ' : ' . $adhesion->getPrice() . " €";
                },
                'expanded' => false,
                'multiple' => false,
                'by_reference' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => null,
        ]);
    }
}
