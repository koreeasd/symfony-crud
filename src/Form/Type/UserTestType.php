<?php


namespace App\Form\Type;

use App\Entity\UserTest;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserTestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Név',
            ])
            ->add('gender', ChoiceType::class, array(
                'choices' => array(
                    'Férfi' => '1',
                    'Nő' => '0',
                ),
                'expanded' => true,
                'label' => 'Nem',
            ))
            ->add('address', TextType::class, [
                'label'=>'Cím',
            ])
            ->add('aboutMe', TextareaType::class, [
                'label' => 'Rólam',
                'required' => false,
            ])
            ->add('isActive',CheckboxType::class, [
                'label' => 'Aktív-e',
                'required' => false,
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Mentés',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UserTest::class,
        ]);
    }
}