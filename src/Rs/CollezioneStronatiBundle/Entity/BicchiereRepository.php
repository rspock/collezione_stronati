<?php

namespace Rs\CollezioneStronatiBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * MignonRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class BicchiereRepository extends OggettoRepository
{
    protected $entityOggetto = 'RsCollezioneStronatiBundle:Bicchiere';

    public function getBicchieriPaginate($idProduttore, $pagina){
        return  $this->getOggettiPaginati($this->entityOggetto, $idProduttore, $pagina);
    }
}
