<?php

namespace Geo\GeoBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping as orm;

/**
 * @orm\Entity(repositoryClass="Geo\GeoBundle\Entity\GeoProvinciaRepository")
 * @orm\Table(name="geo_province", indexes={@orm\Index(name="codice_idx", columns={"codice"}), @orm\Index(name="codice_completo_idx", columns={"codice_completo"})})
 */
class GeoProvincia extends Geo {

    /**
     * @orm\ManyToOne(targetEntity="GeoRegione", inversedBy="province")
     * @orm\JoinColumn(name="regione_id", referencedColumnName="id")
     */
    protected $regione;

    /**
     * @orm\Column(type="string", length=5, nullable = true)
     */
    protected $codice_nuts;

    /**
     * @orm\Column(type="string", length=2)
     */
    protected $sigla_automobilistica;

    /**
     * @orm\OneToMany(targetEntity="GeoComune", mappedBy="provincia")
     */
    protected $comuni;
    
    /**
     * @orm\Column(type="boolean")
     */
    protected $cessata;

    
    public function getRegione() {
        return $this->regione;
    }

    public function setRegione($regione) {
        $this->regione = $regione;
    }

    public function getCodiceNuts() {
        return $this->codice_nuts;
    }

    public function setCodiceNuts($codice_nuts) {
        $this->codice_nuts = $codice_nuts;
    }

    public function getSiglaAutomobilistica() {
        return $this->sigla_automobilistica;
    }

    public function setSiglaAutomobilistica($sigla_automobilistica) {
        $this->sigla_automobilistica = $sigla_automobilistica;
    }

    public function getComuni() {
        return $this->comuni;
    }

    public function setComuni($comuni) {
        $this->comuni = $comuni;
    }
    
    public function getCessata() {
        return $this->cessata;
    }

    public function setCessata($cessata) {
        $this->cessata = $cessata;
    }

}
?>
