<?php

namespace Rs\CollezioneStronatiBundle\Form\BaseType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Rs\CollezioneStronatiBundle\Form\Type;
use Doctrine\ORM\EntityRepository;

class OggettoType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('produttore','entity', array(
            'class' => 'RsCollezioneStronatiBundle:Produttore',
            'property' => 'nome',
            'query_builder' => function(EntityRepository $er) {
                    return $er->createQueryBuilder('p')
                        ->orderBy('p.nome', 'ASC');
                },))
            ->add('descrizione')
            ->add('note')
            ->add("foto", 'fotografie_hidden')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Rs\CollezioneStronatiBundle\Entity\Oggetto'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'rs_collezionestronatibundle_oggetto';
    }
}
