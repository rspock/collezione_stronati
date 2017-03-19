<?php

namespace Geo\GeoBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping as orm;

abstract class Geo {

	public function __toString() {
		return $this->getDenominazione();
	}

    /**
     * @orm\Id
     * @orm\Column(type="bigint")
     * @orm\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @orm\Column(type="string", length=256)
     */
    protected $denominazione;

    /**
     * @orm\Column(type="string", length=15)
     */
    protected $codice_completo;

    /**
     * @orm\Column(type="string", length=3)
     */
    protected $codice;

    /**
     * @orm\Column(type="date")
     */
    protected $data_istituzione;

    /**
     * @orm\Column(type="date", nullable=true)
     */
    protected $data_destituzione;
    
    
    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getDenominazione() {
        return $this->denominazione;
    }

    public function setDenominazione($denominazione) {
        $this->denominazione = $denominazione;
    }

    public function getCodiceCompleto() {
        return $this->codice_completo;
    }

    public function setCodiceCompleto($codice_completo) {
        $this->codice_completo = $codice_completo;
    }

    public function getCodice() {
        return $this->codice;
    }

    public function setCodice($codice) {
        $this->codice = $codice;
    }

    public function getDataIstituzione() {
        return $this->data_istituzione;
    }

    public function setDataIstituzione($data_istituzione) {
        $this->data_istituzione = \is_string($data_istituzione) ? new \DateTime($data_istituzione) : $data_istituzione;
    }

    public function getDataDestituzione() {
        return $this->data_destituzione;
    }

    public function setDataDestituzione($data_destituzione) {
        $this->data_destituzione = \is_string($data_destituzione) ? new \DateTime($data_destituzione) : $data_destituzione;
    }

    
}

?>
