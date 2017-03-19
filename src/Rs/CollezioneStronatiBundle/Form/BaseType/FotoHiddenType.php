<?php
namespace Rs\CollezioneStronatiBundle\Form\BaseType;

use Symfony\Component\Form\AbstractType;
use  Rs\CollezioneStronatiBundle\Service\FotoEntityTransformer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\Common\Persistence\ObjectManager;

class FotoHiddenType extends AbstractType
{
    /**
     * @var ObjectManager
     */
    protected $objectManager;
    public function __construct(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $transformer = new FotoEntityTransformer($this->objectManager);
        $builder->addModelTransformer($transformer);
    }
    /*
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver
            ->setRequired(array('class'))
            ->setDefaults(array(
                'invalid_message' => 'The entity does not exist.',
            ))
        ;
    }
    */

    public function getParent()
    {
        return 'hidden';
    }
    public function getName()
    {
        return 'fotografie_hidden';
    }
} 