<?php

namespace Rs\CollezioneStronatiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Mignon
 *
 * @ORM\Table(name="profumi")
 * @ORM\Entity(repositoryClass="Rs\CollezioneStronatiBundle\Entity\ProfumoRepository")
 */
class Profumo extends Oggetto
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
     * @var boolean
     *
     * @ORM\Column(name="scatola", type="boolean", nullable=true)
     */
    private $scatola;

    /**
     * @var string
     *
     * @ORM\Column(name="localita", type="string", length=1000, nullable=true)
     */
    private $localita;

    function __construct()
    {
        parent::__construct();
        $this->scatola = false;
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
     * @param boolean $scatola
     */
    public function setScatola($scatola)
    {
        $this->scatola = $scatola;
    }

    /**
     * @return boolean
     */
    public function getScatola()
    {
        return $this->scatola;
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
