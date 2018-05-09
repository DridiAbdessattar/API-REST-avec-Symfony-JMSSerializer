<?php

namespace App\Form;

use App\Entity\JeuxVideo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JeuxVideoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id')
            ->add('nom')
            ->add('possesseur')
            ->add('console')
            ->add('prix')
            ->add('nbreJoueursMax')
            ->add('commentaires')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => JeuxVideo::class,
        ]);
    }
}
