<?php

namespace Rs\CollezioneStronatiBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * MignonRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class MignonRepository extends OggettoRepository
{
    protected $entityOggetto = 'RsCollezioneStronatiBundle:Mignon';

    public function getMignonPaginate($idProduttore, $pagina){
        return  $this->getOggettiPaginati($this->entityOggetto, $idProduttore, $pagina);
    }

}