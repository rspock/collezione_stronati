<?php

namespace Geo\GeoBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping as orm;

/**
 * @orm\Entity(repositoryClass="Geo\GeoBundle\Entity\GeoCensimentoRepository")
 * @orm\Table(name="geo_censimenti")
 */
class GeoCensimento {

    /**
     * @orm\Id
     * @orm\Column(type="bigint")
     * @orm\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @orm\Column(type="string", length=5, unique=true)
     */
    protected $codice;

    /**
     * @orm\ManyToOne(targetEntity="GeoStato", inversedBy="censimenti")
     * @orm\JoinColumn(name="stato_id", referencedColumnName="id", nullable=false)
     */
    protected $stato;

    /**
     * @orm\Column(type="date")
     */
    protected $data_censimento;

    /**
     * @orm\Column(type="boolean")
     */
    protected $popolazione_legale;

    /**
     * @orm\OneToMany(targetEntity="GeoPopolazione", mappedBy="censimento")
     */
    protected $popolazioni;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getStato() {
        return $this->stato;
    }

    public function setStato($stato) {
        $this->stato = $stato;
    }

    public function getDataCensimento() {
        return $this->data_censimento;
    }

    public function setDataCensimento($data_censimento) {
        $this->data_censimento = \is_string($data_censimento) ? new \DateTime($data_censimento) : $data_censimento;
    }

    public function getPopolazioneLegale() {
        return $this->popolazione_legale;
    }

    public function setPopolazioneLegale($popolazione_legale) {
        $this->popolazione_legale = $popolazione_legale;
    }

    public function getPopolazioni() {
        return $this->popolazioni;
    }

    public function setPopolazioni($popolazioni) {
        $this->popolazioni = $popolazioni;
    }
    
    public function getCodice() {
        return $this->codice;
    }

    public function setCodice($codice) {
        $this->codice = $codice;
    }

}

?>
