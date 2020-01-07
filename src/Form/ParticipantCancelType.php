<?php

namespace App\Form;

use App\Entity\Participant;
use App\Entity\Payment;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Form\TripToNumberTransformer;

class ParticipantCancelType extends AbstractType
{
    /**
     * @var \App\Form\TripToNumberTransformer
     */
    private $transformer;

    public function __construct(TripToNumberTransformer $transformer)
    {
        $this->transformer = $transformer;
    }


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $options;
        $builder
            ->add('trip', HiddenType::class);

        $builder->get('trip')
            ->addModelTransformer($this->transformer);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Participant::class,
            'allow_extra_fields' => true,
        ]);
    }
}
