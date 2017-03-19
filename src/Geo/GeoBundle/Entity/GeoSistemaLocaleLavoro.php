<?php

namespace Geo\GeoBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping as orm;

/**
 * @orm\Entity(repositoryClass="Geo\GeoBundle\Entity\GeoSistemaLocaleLavoroRepository")
 * @orm\Table(name="geo_sistemi_locale_lavoro")
 */
class GeoSistemaLocaleLavoro {

    /**
     * @orm\Id
     * @orm\Column(type="bigint")
     * @orm\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @orm\Column(type="string", length=3, unique=true)
     */
    protected $codice;

    /**
     * @orm\Column(type="string", length=64)
     */
    protected $denominazione;

    /**
     * @orm\OneToMany(targetEntity="GeoComune", mappedBy="sistema_locale_lavoro")
     */
    protected $comuni;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }
    
    public function getCodice() {
        return $this->codice;
    }

    public function setCodice($codice) {
        $this->codice = $codice;
    }

    public function getDenominazione() {
        return $this->denominazione;
    }

    public function setDenominazione($denominazione) {
        $this->denominazione = $denominazione;
    }

    public function getComuni() {
        return $this->comuni;
    }

    public function setComuni($comuni) {
        $this->comuni = $comuni;
    }

}

?>
