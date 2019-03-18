<?php

namespace App\Form;

use App\Entity\Trips;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class TripsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fly_from')
            ->add('fly_to')
            ->add('depart_time',DateTimeType::class,[
                'input' => 'string',
                'widget' => 'single_text',
                'with_seconds'=> false,
                'view_timezone'=>'Europe/London',

            ])
            ->add('arrival_time', DateTimeType::class,[
                'input' => 'string',
                'widget' => 'single_text',
                'with_seconds'=> false,
                'view_timezone'=>'Europe/London',

            ])
            ->add('pass')
            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Trips::class,
        ]);
    }
}
