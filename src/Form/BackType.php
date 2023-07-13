<?php

namespace App\Form;

use App\Entity\Back;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BackType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) : void
    {
        $builder
            ->add('nombre')
            ->add('logo', FileType::class, [
                'label' => 'Logo',
                'required' => false,
                'mapped' => false,
            ])
            ->add('nivel')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Back::class,
        ]);
    }
}
