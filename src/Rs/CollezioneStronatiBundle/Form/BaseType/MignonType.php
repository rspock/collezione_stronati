<?php

namespace Rs\CollezioneStronatiBundle\Form\BaseType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\Common\Persistence\ObjectManager;

class MignonType extends OggettoType
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
            ->add('contenuto')
            ->add('localita')
            ->add('sigillo','checkbox', array('required' => false));

    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Rs\CollezioneStronatiBundle\Entity\Mignon'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'rs_collezionestronatibundle_mignon';
    }
}
