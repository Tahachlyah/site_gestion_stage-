<?php

namespace App\Form;

use App\Entity\InternshipOffer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InternshipOfferType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('createAt')
            ->add('start_date')
            ->add('end_date')
            ->add('theme')
            ->add('duration')
            ->add('internship_supervisor')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => InternshipOffer::class,
        ]);
    }
}
