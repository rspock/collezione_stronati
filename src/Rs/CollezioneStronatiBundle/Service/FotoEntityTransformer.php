<?php
/**
 * Created by PhpStorm.
 * User: Riccardo
 * Date: 27/12/14
 * Time: 11.30
 */

namespace Rs\CollezioneStronatiBundle\Service;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Form\DataTransformerInterface;
use Doctrine\Common\Persistence\ObjectManager;

class FotoEntityTransformer implements DataTransformerInterface
{
    /**
     * @var ObjectManager
     */
    protected $objectManager;

    
    public function __construct(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }
    public function transform($fotografie)
    {
        if (null === $fotografie) {
            return;
        }

        $valori = "";
        foreach($fotografie as $fotografia){
            $valori .= ($fotografia->getId() . ",");
        }

        return  \substr($valori,0,strlen($valori)-1);
    }
    public function reverseTransform($ids)
    {

        $ac = new ArrayCollection();

        if (!$ids) {
            return $ac;
        }

        $tempArr = explode(',', $ids);


        foreach ($tempArr as $id) {
            $entity = $this->objectManager
                ->getRepository("RsCollezioneStronatiBundle:Foto")
                ->find($id);
            if (is_object($entity)) {
                $ac->add($entity);
            }
        }

        return $ac;
    }
}