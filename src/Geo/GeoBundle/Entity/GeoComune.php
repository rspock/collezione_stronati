<?php

namespace Geo\GeoBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping as orm;

/**
 * @orm\Entity(repositoryClass="Geo\GeoBundle\Entity\GeoComuneRepository")
 * @orm\Table(name="geo_comuni", indexes={@orm\Index(name="codice_idx", columns={"codice"}), @orm\Index(name="codice_completo_idx", columns={"codice_completo"})})
 */
class GeoComune extends Geo {

    /**
     * @orm\Column(type="string", length=128)
     */
    protected $denominazione_it;

    /**
     * @orm\Column(type="string", length=128)
     */
    protected $denominazione_de;

    /**
     * @orm\Column(type="integer")
     */
    protected $capoluogo;

    /**
     * @orm\ManyToOne(targetEntity="GeoZonaAltimetrica", inversedBy="comuni")
     * @orm\JoinColumn(name="zona_altimetrica_id", referencedColumnName="id", nullable=true)
     */
    protected $zona_altimetrica;

    /**
     * @orm\Column(type="decimal", precision=7, scale=2, nullable=true)
     */
    protected $altitudine;

    /**
     * @orm\Column(type="integer", nullable=true)
     */
    protected $litoraneo;

    /**
     * @orm\Column(type="string", length=2, nullable=true)
     */
    protected $montano;

    /**
     * @orm\ManyToOne(targetEntity="GeoSistemaLocaleLavoro", inversedBy="comuni")
     * @orm\JoinColumn(name="sistema_locale_lavoro_id", referencedColumnName="id", nullable=true)
     */
    protected $sistema_locale_lavoro;

    /**
     * @orm\Column(type="decimal", precision=7, scale=2, nullable=true)
     */
    protected $superficie;
	
    /**
     * @orm\ManyToOne(targetEntity="GeoProvincia", inversedBy="comuni")
     * @orm\JoinColumn(name="provincia_id", referencedColumnName="id")
     */
    protected $provincia;

    /**
     * @orm\OneToMany(targetEntity="GeoPopolazione", mappedBy="comune")
     */
    protected $popolazioni;
    
    /**
     * @orm\Column(type="boolean")
     */
    protected $cessato;
    
     /**
     * @orm\Column(type="boolean")
     */   
    protected $ceduto_legge_1989;

    public function getDenominazioneIt() {
        return $this->denominazione_it;
    }

    public function setDenominazioneIt($denominazione_it) {
        $this->denominazione_it = $denominazione_it;
    }

    public function getDenominazioneDe() {
        return $this->denominazione_de;
    }

    public function setDenominazioneDe($denominazione_de) {
        $this->denominazione_de = $denominazione_de;
    }

    public function getCapoluogo() {
        return $this->capoluogo;
    }

    public function setCapoluogo($capoluogo) {
        $this->capoluogo = $capoluogo;
    }

    public function getZonaAltimetrica() {
        return $this->zona_altimetrica;
    }

    public function setZonaAltimetrica($zona_altimetrica) {
        $this->zona_altimetrica = $zona_altimetrica;
    }

    public function getAltitudine() {
        return $this->altitudine;
    }

    public function setAltitudine($altitudine) {
        $this->altitudine = $altitudine;
    }

    public function getLitoraneo() {
        return $this->litoraneo;
    }

    public function setLitoraneo($litoraneo) {
        $this->litoraneo = $litoraneo;
    }

    public function getMontano() {
        return $this->montano;
    }

    public function setMontano($montano) {
        $this->montano = $montano;
    }

    public function getSistemaLocaleLavoro() {
        return $this->sistema_locale_lavoro;
    }

    public function setSistemaLocaleLavoro($sistema_locale_lavoro) {
        $this->sistema_locale_lavoro = $sistema_locale_lavoro;
    }

    public function getSuperficie() {
        return $this->superficie;
    }

    public function setSuperficie($superficie) {
        $this->superficie = $superficie;
    }

    public function getProvincia() {
        return $this->provincia;
    }

    public function setProvincia($provincia) {
        $this->provincia = $provincia;
    }

    public function getPopolazioni() {
        return $this->popolazioni;
    }

    public function setPopolazioni($popolazioni) {
        $this->popolazioni = $popolazioni;
    }
    
    public function getCessato() {
        return $this->cessato;
    }

    public function setCessato($cessato) {
        $this->cessato = $cessato;
    }

    public function getCedutoLegge1989() {
        return $this->ceduto_legge_1989;
    }

    public function setCedutoLegge1989($ceduto_legge_1989) {
        $this->ceduto_legge_1989 = $ceduto_legge_1989;
    }      

}

?>
