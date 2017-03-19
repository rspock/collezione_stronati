<?php

namespace Geo\GeoBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping as orm;

/**
 * @ORM\Table(name="ateco_2002")
 * @ORM\Entity(repositoryClass="Geo\GeoBundle\Entity\Ateco2002")
 */

class Ateco2002
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @orm\Column(name="codice", type="string", length=20)
     */
    protected $codice;

    /**
     * @orm\Column(name="descrizione", type="string", length=256)
     */
    protected $descrizione;
    
    public function getId() {
        return $this->Id;
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
    
    public function getDescrizione() {
        return $this->codice;
    }

    public function setDescrizione($descrizione) {
        $this->descrizione = $descrizione;
    }
}
?>
