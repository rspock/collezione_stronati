<?php

namespace Geo\GeoBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping as orm;

/**
 * @orm\Entity(repositoryClass="Geo\GeoBundle\Entity\GeoZonaAltimetricaRepository")
 * @orm\Table(name="geo_zone_altimetriche")
 */
class GeoZonaAltimetrica {

    /**
     * @orm\Id
     * @orm\Column(type="bigint")
     * @orm\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @orm\Column(type="string", length=1, unique=true)
     */
    protected $codice;

    /**
     * @orm\Column(type="string", length=20)
     */
    protected $zona;

    /**
     * @orm\OneToMany(targetEntity="GeoComune", mappedBy="zona_altimetrica")
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

    public function getZona() {
        return $this->zona;
    }

    public function setZona($zona) {
        $this->zona = $zona;
    }

    public function getComuni() {
        return $this->comuni;
    }

    public function setComuni($comuni) {
        $this->comuni = $comuni;
    }
    
}

?>
