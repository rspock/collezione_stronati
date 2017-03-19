<?php
/**
 * Created by PhpStorm.
 * User: Riccardo
 * Date: 04/10/14
 * Time: 14.36
 */

namespace Rs\CollezioneStronatiBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class IndirizzoType extends AbstractType {

    public function __construct() {

    }

    public function getName() {
        return "indirizzo";
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('via', 'text', array('label' => 'Via'));
        $builder->add('numero_civico', 'text', array('label' => 'Numero civico'));

        $builder->add('stato', 'entity', array(
                'class' => 'Geo\GeoBundle\Entity\GeoStato',
                'property' => 'denominazione',
                'empty_value' => '-',
                'required' => false,
                'label' => 'Stato'
            )
        );

        $builder->add('provincia', 'entity', array(
                'class' => 'Geo\GeoBundle\Entity\GeoProvincia',
                'property' => 'denominazione',
                'empty_value' => '-',
                'required' => false,
                'label' => 'Provincia'
            )
        );

        $builder->add('citta', 'entity', array(
                'class' => 'Geo\GeoBundle\Entity\GeoComune',
                'property' => 'denominazione',
                'empty_value' => '-',
                'required' => false,
                'label' => 'Citta'
            )
        );

        $builder->add('cap', 'text', array('required' => true, 'max_length' => 5, 'label' => 'CAP'));

    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        parent::setDefaultOptions($resolver);
        $resolver->setDefaults(array(
            'data_class' => 'Rs\CollezioneStronatiBundle\Entity\Indirizzo'
        ));
    }

}

?>
