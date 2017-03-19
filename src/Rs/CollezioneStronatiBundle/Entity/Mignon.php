<?php

namespace Rs\CollezioneStronatiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Mignon
 *
 * @ORM\Table(name="mignon")
 * @ORM\Entity(repositoryClass="Rs\CollezioneStronatiBundle\Entity\MignonRepository")
 */
class Mignon extends Oggetto
{

    /**
     * @var string
     *
     * @ORM\Column(name="altezza", type="string", nullable=true)
     */
    private $altezza;


    /**
 * @var string
 *
 * @ORM\Column(name="contenuto", type="string", length=1000, nullable=true)
 */
    private $contenuto;

    /**
     * @var string
     *
     * @ORM\Column(name="localita", type="string", length=255, nullable=true)
     */
    private $localita;

    /**
     * @var boolean
     *
     * @ORM\Column(name="sigillo", type="boolean")
     */
    private $sigillo;

    function __construct()
    {
        parent::__construct();
        $this->sigillo = false;
    }


    /**
     * Set altezza
     *
     * @param string $altezza
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
     * @return string
     */
    public function getAltezza()
    {
        return $this->altezza;
    }

    /**
     * Set contenuto
     *
     * @param string $contenuto
     * @return Mignon
     */
    public function setContenuto($contenuto)
    {
        $this->contenuto = $contenuto;

        return $this;
    }

    /**
     * Get contenuto
     *
     * @return string 
     */
    public function getContenuto()
    {
        return $this->contenuto;
    }

    /**
     * Set sigillo
     *
     * @param boolean $sigillo
     * @return Mignon
     */
    public function setSigillo($sigillo)
    {
        $this->sigillo = $sigillo;

        return $this;
    }

    /**
     * Get sigillo
     *
     * @return boolean 
     */
    public function getSigillo()
    {
        return $this->sigillo;
    }

    /**
     * @param string $localita
     */
    public function setLocalita($localita)
    {
        $this->localita = $localita;
    }

    /**
     * @return string
     */
    public function getLocalita()
    {
        return $this->localita;
    }

}
