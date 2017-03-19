<?php

namespace Rs\CollezioneStronatiBundle\Form\BaseType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BicchiereType extends OggettoType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder
            ->add('altezza')
            ->add('liquore')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Rs\CollezioneStronatiBundle\Entity\Bicchiere'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'rs_collezionestronatibundle_bicchiere';
    }
}
