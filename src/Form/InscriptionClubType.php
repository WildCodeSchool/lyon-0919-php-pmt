<?php

namespace App\Form;

use App\Entity\AdhesionPrice;
use App\Entity\Document;
use App\Entity\Inscription;
use App\Entity\Insurance;
use App\Entity\Level;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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
        $builder
            ->add('user', UserType::class, ['data' => $options['user'], 'label' => false])
            ->add('inscription', InscriptionType::class, ['data' => new Inscription()])
            ->add('level', EntityType::class, [
                'class' => Level::class,
                'choice_label' => 'name',
                'expanded' => false,
                'multiple' => false,
                'by_reference' => false,
            ])
            ->add('insurance', EntityType::class, [
                'class' => Insurance::class,
                'choice_label' => function ($insurance) {
                    return $insurance->getName() . ' : ' . $insurance->getPrice() . " €";
                },
                'expanded' => false,
                'multiple' => false,
                'by_reference' => true,
            ])
            ->add('adhesion', EntityType::class, [
                'class' => AdhesionPrice::class,
                'choice_label' => function ($adhesion) {
                    return $adhesion->getName() . ' : ' . $adhesion->getPrice() . " €";
                },
                'expanded' => false,
                'multiple' => false,
                'by_reference' => true,
            ])
            ->add('validation', ChoiceType::class, [
                'required' => true,
                'choices' => ['Je reconnais avoir pris connaissance du règlement du PMT et je m\'engage à le respecter.
L\'inscription au PMT comprend l\'adhésion à l\'assurance individuelle AXA pour la catégorie 1.
J\'ai été informé des caractéristiques des options complémentaires.' => '1'],
                'expanded' => true,
                'multiple' => false,
                'by_reference' => false,
            ])
            ->add('imageRight', ChoiceType::class, [
                'required' => true,
                'choices' => ['oui' => '1' , 'non' =>'0'],
                'expanded' => true,
                'multiple' => false,
                'by_reference' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => null,
            'user' => null,
        ]);
    }
}
