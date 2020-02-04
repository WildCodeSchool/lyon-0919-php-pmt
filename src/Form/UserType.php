<?php

namespace App\Form;

use App\Entity\Level;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Validator\Constraints\File;

class UserType extends AbstractType
{
    protected $auth;

    public function __construct(AuthorizationCheckerInterface $auth)
    {
        $this->auth = $auth;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // Use the user object to build the form
        $options = $options; // Avoid PhpMd warning
        $builder
            ->add('firstname')
            ->add('lastname')
            ->add('email')
            ->add('homePhone')
            ->add('mobilePhone')
            ->add('birthday', BirthdayType::class)
            ->add('comment', TextareaType::class, array(
                'attr' => array('cols' => '5', 'rows' => '5'),
            ))
            ->add('address')
            ->add('zipCode')
            ->add('city')
            ->add('imageName', HiddenType::class)
            ->add('ImageFile', FileType::class, [
                'label' => 'Charger ma photo',
                'mapped' => false,
                'required' => false,
                'attr' => ['placeholder' => 'Choisir une image' ,  'lang'=>"fr"],
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/jpg',
                            'image/jpeg',
                            'image/png',
                        ],
                        'mimeTypesMessage' => 'L\'image doit être au format jpg, jpeg ou png',
                    ])
                ],
            ]);
        if ($this->auth->isGranted('ROLE_ADMIN')) {
            $builder->add('isMonitor')
                ->add('isSwim')
                ->add('isDiver')
                ->add('isHandi')
                ->add('level', EntityType::class, [
                    'class' => Level::class,
                    'choice_label' => 'name',
                ]);
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
