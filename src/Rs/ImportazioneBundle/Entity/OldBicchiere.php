<?php

namespace Rs\ImportazioneBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldBicchiere
 *
 * @ORM\Table(name="bicchiere")
 * @ORM\Entity(repositoryClass="Rs\ImportazioneBundle\Entity\OldBicchiereRepository")
 */
class OldBicchiere
{
    /**
     * @var integer
     *
     * @ORM\Column(name="codice", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $codice;

    /**
     * @var string
     *
     * @ORM\Column(name="ditta", type="string", length=50)
     */
    private $ditta;
    /**
     * @var string
     *
     * @ORM\Column(name="liquore", type="string", length=100)
     */
    private $liquore;
    /**
     * @var string
     *
     * @ORM\Column(name="foto", type="string", length=70)
     */
    private $foto;
    /**
     * @var string
     *
     * @ORM\Column(name="altezza", type="string", length=100)
     */
    private $altezza;

    /**
     * @param string $altezza
     */
    public function setAltezza($altezza)
    {
        $this->altezza = $altezza;
    }

    /**
     * @return string
     */
    public function getAltezza()
    {
        return $this->altezza;
    }

    /**
     * @param int $codice
     */
    public function setCodice($codice)
    {
        $this->codice = $codice;
    }

    /**
     * @return int
     */
    public function getCodice()
    {
        return $this->codice;
    }

    /**
     * @param string $ditta
     */
    public function setDitta($ditta)
    {
        $this->ditta = $ditta;
    }

    /**
     * @return string
     */
    public function getDitta()
    {
        return $this->ditta;
    }

    /**
     * @param string $foto
     */
    public function setFoto($foto)
    {
        $this->foto = $foto;
    }

    /**
     * @return string
     */
    public function getFoto()
    {
        return $this->foto;
    }

    /**
     * @param string $liquore
     */
    public function setLiquore($liquore)
    {
        $this->liquore = $liquore;
    }

    /**
     * @return string
     */
    public function getLiquore()
    {
        return $this->liquore;
    }



}
