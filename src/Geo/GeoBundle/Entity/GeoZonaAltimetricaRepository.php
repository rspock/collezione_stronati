<?php

namespace Geo\GeoBundle\Entity;

use Doctrine\ORM\EntityRepository;

class GeoZonaAltimetricaRepository extends EntityRepository {

    public function getList($from, $to, $orderBy = null, $asc = false) {
        $q = $this->getEntityManager()
                ->createQuery('SELECT g FROM Geo\GeoBundle:GeoZonaAltimetrica g ORDER BY d.' . ($orderBy ? : 'codice_zona') . ($asc ? ' ASC' : ' DESC'));
        $q->setMaxResults($to - $from + 1);
        $q->setFirstResult($from);
        return $q->getResult();
    }


}

?>
