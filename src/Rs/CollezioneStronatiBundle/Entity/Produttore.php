<?php

namespace Rs\CollezioneStronatiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Exclude;

/**
 * Produttore
 *
 * @ORM\Table(name="produttori")
 * @ORM\Entity(repositoryClass="Rs\CollezioneStronatiBundle\Entity\ProduttoreRepository")
 */
class Produttore
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=255, unique = true)
     */
    private $nome;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dataCreazione", type="date", nullable=true)
     */
    private $dataCreazione;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dataChiusura", type="date", nullable=true)
     */
    private $dataChiusura;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dataFondazione", type="date", nullable=true)
     */
    private $dataFondazione;

    /**
     * @ORM\ManyToOne(targetEntity="Indirizzo", cascade={"persist"})
     * */
    private $indirizzo;

    /**
     * @ORM\OneToMany(targetEntity="Oggetto", mappedBy="produttore")
     * @Exclude
     * */
    private $oggetto;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nome
     *
     * @param string $nome
     * @return Produttore
     */
    public function setNome($nome)
    {
        if(!is_null($nome)){
            $this->nome = \strtoupper (\trim($nome));
        }else{
            $this->nome = $nome;
        }


        return $this;
    }

    /**
     * Get nome
     *
     * @return string 
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set dataCreazione
     *
     * @param \DateTime $dataCreazione
     * @return Produttore
     */
    public function setDataCreazione($dataCreazione)
    {
        $this->dataCreazione = $dataCreazione;

        return $this;
    }

    /**
     * Get dataCreazione
     *
     * @return \DateTime 
     */
    public function getDataCreazione()
    {
        return $this->dataCreazione;
    }

    /**
     * Set dataChiusura
     *
     * @param \DateTime $dataChiusura
     * @return Produttore
     */
    public function setDataChiusura($dataChiusura)
    {
        $this->dataChiusura = $dataChiusura;

        return $this;
    }

    /**
     * Get dataChiusura
     *
     * @return \DateTime 
     */
    public function getDataChiusura()
    {
        return $this->dataChiusura;
    }

    /**
     * Set dataFondazione
     *
     * @param \DateTime $dataFondazione
     * @return Produttore
     */
    public function setDataFondazione($dataFondazione)
    {
        $this->dataFondazione = $dataFondazione;

        return $this;
    }

    /**
     * Get dataFondazione
     *
     * @return \DateTime 
     */
    public function getDataFondazione()
    {
        return $this->dataFondazione;
    }

    /**
     * Set indirizzo
     *
     * @param string $indirizzo
     * @return Produttore
     */
    public function setIndirizzo($indirizzo)
    {
        $this->indirizzo = $indirizzo;

        return $this;
    }

    /**
     * Get indirizzo
     *
     * @return string 
     */
    public function getIndirizzo()
    {
        return $this->indirizzo;
    }

    /**
     * @param mixed $oggetto
     */
    public function setOggetto($oggetto)
    {
        $this->oggetto = $oggetto;
    }

    /**
     * @return mixed
     */
    public function getOggetto()
    {
        return $this->oggetto;
    }


}
