<?php

namespace Rs\CollezioneStronatiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Mignon
 *
 * @ORM\Table(name="bicchieri")
 * @ORM\Entity(repositoryClass="Rs\CollezioneStronatiBundle\Entity\BicchiereRepository")
 */
class Bicchiere extends Oggetto
{

    /**
     * @var float
     *
     * @ORM\Column(name="altezza", type="float", nullable=true)
     */
    private $altezza;

    /**
     * @var string
     *
     * @ORM\Column(name="liquore", type="string", length=1000, nullable=true)
     */
    private $liquore;

    function __construct()
    {
        parent::__construct();
    }


    /**
     * Set altezza
     *
     * @param float $altezza
     * @return Mignon
     */
    public function setAltezza($altezza)
    {
        $this->altezza = $altezza;

        return $this;
    }

    /**
     * Get altezza
     *
     * @return float 
     */
    public function getAltezza()
    {
        return $this->altezza;
    }

    /**
     * @param string $liquore
     */
    public function setLiquore($liquore)
    {
        $this->liquore = $liquore;
    }

    /**
     * @return string
     */
    public function getLiquore()
    {
        return $this->liquore;
    }



}
