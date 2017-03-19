<?php

namespace Geo\GeoBundle\Entity;

use Doctrine\ORM\EntityRepository;

class GeoRegioneRepository extends GeoRepository {

    protected function getGeoTable() {
        return 'GeoRegione';
    }
    
    public function regioniList() {
        $q = $this->getEntityManager()
			->createQuery('SELECT r FROM Geo\GeoBundle:GeoRegione r ORDER BY r.denominazione ASC');
        return $q->getResult();
    }

}

?>
