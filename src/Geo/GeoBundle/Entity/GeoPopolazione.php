<?php

namespace Geo\GeoBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping as orm;

/**
 * @orm\Entity(repositoryClass="Geo\GeoBundle\Entity\GeoPopolazioneRepository")
 * @orm\Table(name="geo_popolazione")
 */
class GeoPopolazione {

    /**
     * @orm\Id
     * @orm\Column(type="bigint")
     * @orm\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @orm\ManyToOne(targetEntity="GeoComune", inversedBy="popolazioni")
     * @orm\JoinColumn(name="comune_id", referencedColumnName="id", nullable=false)
     */
    protected $comune;

    /**
     * @orm\ManyToOne(targetEntity="GeoCensimento", inversedBy="popolazioni")
     * @orm\JoinColumn(name="censimento_id", referencedColumnName="id", nullable=false)
     */
    protected $censimento;

    /**
     * @orm\Column(type="bigint")
     */
    protected $popolazione;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getComune() {
        return $this->comune;
    }

    public function setComune($comune) {
        $this->comune = $comune;
    }
    
    public function getCensimento() {
        return $this->censimento;
    }

    public function setCensimento($censimento) {
        $this->censimento = $censimento;
    }
    
    public function getPopolazione() {
        return $this->popolazione;
    }

    public function setPopolazione($popolazione) {
        $this->popolazione = $popolazione;
    }

}

?>
