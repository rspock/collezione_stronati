<?php

namespace Rs\CollezioneStronatiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="Rs\CollezioneStronatiBundle\Entity\OggettoRepository")
 * @ORM\Table("oggetti")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"mignon" = "Mignon", "bicchiere" = "Bicchiere", "profumo"= "Profumo"})
 */
abstract class Oggetto
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Produttore", cascade={"persist"}, inversedBy="oggetto")
     * @ORM\JoinColumn(name="produttore_id", referencedColumnName="id", nullable = false)
     * */
    protected $produttore;

    /**
     *
     * @ORM\Column(name="descrizione", type="text")
     */
    protected $descrizione;
    /**
     *
     * @ORM\Column(name="note", type="text", nullable=true)
     */
    protected $note;

    /**
     * @var string
     *
     * @ORM\Column(name="dispositivoUno", type="boolean", nullable=true)
     */
    protected $dispositivoUno;

    /**
     * @var string
     *
     * @ORM\Column(name="dispositivoDue", type="boolean", nullable=true)
     */
    protected $dispositivoDue;

    /**
     * @var string
     *
     * @ORM\Column(name="dispositivoTre", type="boolean", nullable=true)
     */
    protected $dispositivoTre;


    /**
     * @ORM\OneToMany(targetEntity="Foto", cascade={"all"}, mappedBy="oggetto")
     * */
    protected $foto;

    function __construct()
    {
        $this->foto = new ArrayCollection();
    }


    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $descrizione
     */
    public function setDescrizione($descrizione)
    {
        $this->descrizione = $descrizione;
    }

    /**
     * @return mixed
     */
    public function getDescrizione()
    {
        return $this->descrizione;
    }

    /**
     * @param mixed $dispositivoDue
     */
    public function setDispositivoDue($dispositivoDue)
    {
        $this->dispositivoDue = $dispositivoDue;
    }

    /**
     * @return mixed
     */
    public function getDispositivoDue()
    {
        return $this->dispositivoDue;
    }

    /**
     * @param mixed $dispositivoTre
     */
    public function setDispositivoTre($dispositivoTre)
    {
        $this->dispositivoTre = $dispositivoTre;
    }

    /**
     * @return mixed
     */
    public function getDispositivoTre()
    {
        return $this->dispositivoTre;
    }

    /**
     * @param mixed $dispositivoUno
     */
    public function setDispositivoUno($dispositivoUno)
    {
        $this->dispositivoUno = $dispositivoUno;
    }

    /**
     * @return mixed
     */
    public function getDispositivoUno()
    {
        return $this->dispositivoUno;
    }

    /**
     * @param mixed $foto
     */
    public function setFoto($foto)
    {
        $this->foto = $foto;
        /*
        if($foto!=null && \is_array($foto)){
            $this->foto = new ArrayCollection($foto);
        }else if ($foto != null && is_object($foto)){
            $this->foto = new ArrayCollection(array($foto));
        }else if ($foto != null && $foto instanceof ArrayCollection){
            $this->foto = $foto;
        }else{
            $this->foto=null;
        }
        */
    }

    /**
     * @return ArrayCollection
     */
    public function getFoto()
    {
        return $this->foto;
    }

    /**
     * @param mixed $note
     */
    public function setNote($note)
    {
        $this->note = $note;
    }

    /**
     * @return mixed
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * @param mixed $produttore
     */
    public function setProduttore($produttore)
    {
        $this->produttore = $produttore;
    }

    /**
     * @return mixed
     */
    public function getProduttore()
    {
        return $this->produttore;
    }


}
