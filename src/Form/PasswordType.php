<?php


namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $options;
        $builder
        ->add('password', RepeatedType::class, [
            'type'=>PasswordType::class,
            'invalid_message'=>'Veuillez entrer le mot de passe correct.',
            'options'=>['attr'=>['class'=>'password-field']],
            'required'=>true,
            'first_options'=>['label'=>'Password'],
            'second_options'=>['label'=>'Repeat Password'],
        ]);
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User:: class
        ]);
    }
}
