<?php

namespace App\Form;

use App\Entity\Passengers;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
class PassengersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', ChoiceType::class, [
            'choices'  => [
                'Mr.' => 'Mr.',
                'Miss' => 'Miss'
            ]
        ])
            ->add('first_name')
            ->add('surname')
            ->add('passport_id')
            ->add('save', SubmitType::class);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Passengers::class,
        ]);
    }
}
