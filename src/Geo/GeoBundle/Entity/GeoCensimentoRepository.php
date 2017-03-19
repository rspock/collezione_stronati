<?php

namespace Geo\GeoBundle\Entity;

use Doctrine\ORM\EntityRepository;

class GeoCensimentoRepository extends EntityRepository {

    public function getList($from, $to, $orderBy = null, $asc = false) {
        $q = $this->getEntityManager()
                ->createQuery('SELECT g FROM Geo\GeoBundle:GeoCensimento g ORDER BY d.' . ($orderBy ? : 'data_censiento') . ($asc ? ' ASC' : ' DESC'));
        $q->setMaxResults($to - $from + 1);
        $q->setFirstResult($from);
        return $q->getResult();
    }


}

?>
