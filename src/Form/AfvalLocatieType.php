<?php

namespace App\Form;

use App\Entity\Locatie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AfvalLocatieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('naam')
            ->add('adres')
            ->add('plaats')
            ->add('straat')
            ->add('straat_nr')
            ->add('straat_nr_bijv')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Locatie::class,
        ]);
    }
}
