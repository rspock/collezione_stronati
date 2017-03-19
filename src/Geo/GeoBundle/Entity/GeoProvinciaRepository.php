<?php

namespace Geo\GeoBundle\Entity;

use Doctrine\ORM\EntityRepository;

class GeoProvinciaRepository extends GeoRepository {

    protected function getGeoTable() {
        return 'GeoProvincia';
    }

    public function provinceList($id_regione = null, $stato_cessazione = null) {
        $qb = $this->createQueryBuilder('p');

        $method = "where";

        if ($id_regione) {
            $qb->where('p.regione = :regione_id')
                    ->setParameter('regione_id', $id_regione);

            $method = "andWhere";
        }

        if ($stato_cessazione == "cessate") {
            $qb->$method('p.cessata = :stato_cessazione')
                    ->setParameter('stato_cessazione', 1);
        } elseif ($stato_cessazione == "non-cessate") {
            $qb->$method('p.cessata = :stato_cessazione')
                    ->setParameter('stato_cessazione', 0);
        }

        $qb->orderBy('p.denominazione', 'ASC');
        return $qb->getQuery()->getResult();
    }

}

?>
