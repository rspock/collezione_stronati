<?php

namespace Rs\CollezioneStronatiBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProduttoreType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nome')
            ->add('dataCreazione')
            ->add('dataChiusura')
            ->add('dataFondazione')
            ->add('indirizzo', new IndirizzoType())
            ->add("fotoSelezionate", "collection", array(
                "mapped" => false
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Rs\CollezioneStronatiBundle\Entity\Produttore'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'rs_collezionestronatibundle_produttore';
    }
}
