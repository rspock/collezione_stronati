<?php

namespace Rs\ImportazioneBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OldMignon
 *
 * @ORM\Table(name="bottiglia")
 * @ORM\Entity(repositoryClass="Rs\ImportazioneBundle\Entity\OldMignonRepository")
 */
class OldMignon
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
     * @ORM\Column(name="produttore", type="string", length=20)
     */
    private $produttore;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=20)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="descrizione", type="string")
     */
    private $descrizione;

    /**
     * @var string
     *
     * @ORM\Column(name="foto", type="string", length=50)
     */
    private $foto;

    /**
     * @var string
     *
     * @ORM\Column(name="foto_retro", type="string", length=50)
     */
    private $fotoRetro;

    /**
     * @var string
     *
     * @ORM\Column(name="localita", type="string", length=20)
     */
    private $localita;

    /**
     * @var string
     *
     * @ORM\Column(name="altezza", type="string", length=10)
     */
    private $altezza;

    /**
     * @var string
     *
     * @ORM\Column(name="contenuto", type="string", length=10)
     */
    private $contenuto;

    /**
     * @var string
     *
     * @ORM\Column(name="sigillo", type="string", length=10)
     */
    private $sigillo;


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
     * @param string $contenuto
     */
    public function setContenuto($contenuto)
    {
        $this->contenuto = $contenuto;
    }

    /**
     * @return string
     */
    public function getContenuto()
    {
        return $this->contenuto;
    }

    /**
     * @param string $descrizione
     */
    public function setDescrizione($descrizione)
    {
        $this->descrizione = $descrizione;
    }

    /**
     * @return string
     */
    public function getDescrizione()
    {
        return $this->descrizione;
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
     * @param string $fotoRetro
     */
    public function setFotoRetro($fotoRetro)
    {
        $this->fotoRetro = $fotoRetro;
    }

    /**
     * @return string
     */
    public function getFotoRetro()
    {
        return $this->fotoRetro;
    }

    /**
     * @param string $localita
     */
    public function setLocalita($localita)
    {
        $this->localita = $localita;
    }

    /**
     * @return string
     */
    public function getLocalita()
    {
        return $this->localita;
    }

    /**
     * @param string $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }


    /**
     * @param string $produttore
     */
    public function setProduttore($produttore)
    {
        $this->produttore = $produttore;
    }

    /**
     * @return string
     */
    public function getProduttore()
    {
        return $this->produttore;
    }

    /**
     * @param string $sigillo
     */
    public function setSigillo($sigillo)
    {
        $this->sigillo = $sigillo;
    }

    /**
     * @return string
     */
    public function getSigillo()
    {
        return $this->sigillo;
    }


}
