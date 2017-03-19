<?php

namespace Geo\GeoBundle\Entity;

use Doctrine\ORM\EntityRepository;

class GeoStatoRepository extends GeoRepository {

    protected function getGeoTable() {
        return 'GeoStato';
    }

	public function statiList() {
        $q = $this->getEntityManager()
			->createQuery('SELECT s FROM Geo\GeoBundle:GeoStato s ORDER BY s.id ASC');
        return $q->getResult();
    }

}

?>
