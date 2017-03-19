<?php

namespace Rs\CollezioneStronatiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Entity indirizzi
 * 
 * @ORM\Entity
 * @ORM\Table("indirizzi") 
 * 
 */
class Indirizzo {

    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string $via
     * @ORM\Column(name="via", type="string", length=50, nullable=true)
     */
    protected $via;

    /**
     * @var string $numero_civico
     * @ORM\Column(name="numero_civico", type="string", length=10, nullable=true)
     */
    protected $numero_civico;

    /**
     * @var string $numero_civico
     * @ORM\Column(name="cap", type="string", length=5, nullable=true)
     */
    protected $cap;

    /**
     * @var Geo\GeoBundle\Entity\GeoStato $stato
     *
     * @ORM\ManyToOne(targetEntity="Geo\GeoBundle\Entity\GeoStato")
     * @ORM\JoinColumn(nullable=true)
     *
     */
    protected $stato;

    /**
     * @var string $provincia
     *
     * @ORM\ManyToOne(targetEntity="Geo\GeoBundle\Entity\GeoProvincia")
     * @ORM\JoinColumn(nullable=true)
     */

    protected $provincia;

    /**
     * @var string $citta
     *
     * @ORM\ManyToOne(targetEntity="Geo\GeoBundle\Entity\GeoComune")
     * @ORM\JoinColumn(nullable=true)
     */
    protected $citta;

    public function getId() {
        return $this->id;
    }

    public function getVia() {
        return $this->via;
    }

    public function getNumeroCivico() {
        return $this->numero_civico;
    }

    public function getCap() {
        return $this->cap;
    }

    public function getStato() {
        return $this->stato;
    }

    public function getProvincia() {
        return $this->provincia;
    }

    public function getCitta() {
        return $this->citta;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setVia($via) {
        $this->via = $via;
    }

    public function setNumeroCivico($numero_civico) {
        $this->numero_civico = $numero_civico;
    }

    public function setCap($cap) {
        $this->cap = $cap;
    }

    public function setStato(\Geo\GeoBundle\Entity\GeoStato $stato) {
        $this->stato = $stato;
    }

    public function setProvincia(\Geo\GeoBundle\Entity\GeoProvincia $provincia) {
        $this->provincia = $provincia;
    }

    public function setCitta(\Geo\GeoBundle\Entity\GeoComune $citta) {
        $this->citta = $citta;
    }

    public function __toString() {
        $indirizzo="";
        $indirizzo.= is_null($this->via)? " " : $this->via." ";
        $indirizzo.= is_null($this->numero_civico)? " " : $this->numero_civico." ";
        $indirizzo.= is_null($this->cap)? " " : $this->cap." ";
        $indirizzo.= is_null($this->stato)? " " : $this->stato." ";
        return $indirizzo;
    }
}