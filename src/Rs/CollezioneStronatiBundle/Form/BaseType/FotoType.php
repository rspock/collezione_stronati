<?php

namespace Rs\CollezioneStronatiBundle\Form\BaseType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FotoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder->add('id', 'entity_hidden', array(
            'class' => 'Rs\CollezioneStronatiBundle\Entity\Foto'
        ));
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Rs\CollezioneStronatiBundle\Entity\Foto'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'rs_collezionestronatibundle_foto';
    }
}
