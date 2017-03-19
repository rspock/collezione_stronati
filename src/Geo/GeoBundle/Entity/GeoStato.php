<?php

namespace Geo\GeoBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping as orm;

/**
 * @orm\Entity(repositoryClass="Geo\GeoBundle\Entity\GeoStatoRepository")
 * @orm\Table(name="geo_stati", indexes={@orm\Index(name="codice_idx", columns={"codice"}), @orm\Index(name="codice_completo_idx", columns={"codice_completo"})})
 */
class GeoStato extends Geo {

    /**
	 *
	 * @orm\ManyToOne(targetEntity="GeoAreaGeopolitica", inversedBy="stati")
     * @orm\JoinColumn(name="area_geopolitica_id", referencedColumnName="id")
     */
    protected $area_geopolitica;

    /**
     * @orm\OneToMany(targetEntity="GeoRegione", mappedBy="stato")
     */
    protected $regioni;

    /**
     * @orm\OneToMany(targetEntity="GeoCensimento", mappedBy="stato")
     */
    protected $censimenti;

    public function getAreaGeopolitica() {
        return $this->area_geopolitica;
    }

    public function setAreaGeopolitica($area_geopolitica) {
        $this->area_geopolitica = $area_geopolitica;
    }

    public function getRegioni() {
        return $this->regioni;
    }

    public function setRegioni($regioni) {
        $this->regioni = $regioni;
    }
    
    public function getCensimenti() {
        return $this->censimenti;
    }

    public function setCensimenti($censimenti) {
        $this->censimenti = $censimenti;
    }


}

?>
