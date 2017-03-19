<?php

namespace Rs\CollezioneStronatiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Exclude;


/**
 * Foto
 *
 * @ORM\Table(name="foto")
 * @ORM\Entity
 */
class Foto
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
     * @ORM\Column(name="tmp_name", type="string", length=255)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="mime", type="string", length=50)
     */
    private $mime;

    /**
     * @var integer
     *
     * @ORM\Column(name="dimensioni", type="integer")
     */
    private $dimensioni;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=255, nullable=true)
     */
    private $tipo;

    /**
     * @var string
     *
     * @ORM\Column(name="contenuto", type="blob")
     */
    private $contenuto;

    /**
     * @ORM\ManyToOne(targetEntity="Oggetto", inversedBy="foto")
     * @ORM\JoinColumn(name="oggetto_id", referencedColumnName="id", nullable = true)
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

    public function setId($id){
        $this->id = $id;
    }

    /**
     * Set mime
     *
     * @param string $mime
     * @return Foto
     */
    public function setMime($mime)
    {
        $this->mime = $mime;

        return $this;
    }

    /**
     * Get mime
     *
     * @return string 
     */
    public function getMime()
    {
        return $this->mime;
    }

    /**
     * Set dimensioni
     *
     * @param integer $dimensioni
     * @return Foto
     */
    public function setDimensioni($dimensioni)
    {
        $this->dimensioni = $dimensioni;

        return $this;
    }

    /**
     * Get dimensioni
     *
     * @return integer 
     */
    public function getDimensioni()
    {
        return $this->dimensioni;
    }

    /**
     * Set tipo
     *
     * @param string $tipo
     * @return Foto
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return string 
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set contenuto
     *
     * @param string $contenuto
     * @return Foto
     */
    public function setContenuto($contenuto)
    {
        $this->contenuto = $contenuto;

        return $this;
    }

    /**
     * Get contenuto
     *
     * @return string 
     */
    public function getContenuto()
    {
        return $this->contenuto;
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


    public function getStream(){
        return \base64_encode(stream_get_contents($this->contenuto));
    }
}
