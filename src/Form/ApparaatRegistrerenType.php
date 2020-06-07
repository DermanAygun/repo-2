<?php

namespace App\Form;

use App\Entity\Apparaat;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ApparaatRegistrerenType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('naam')
            ->add('inname_door')
            ->add('in_elkaar')
            ->add('verkocht_gekocht')
            ->add('locaties')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Apparaat::class,
        ]);
    }
}
