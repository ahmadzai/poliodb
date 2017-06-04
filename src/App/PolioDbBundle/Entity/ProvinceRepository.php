<?php
namespace App\PolioDbBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

class ProvinceRepository extends EntityRepository {
    /***
     * @return array
     */
    public function selectAllDistricts() {
        return $this->getEntityManager()
            ->createQuery(
                "SELECT d FROM AppPolioDbBundle:DistrictData d"
            )
            ->getResult(Query::HYDRATE_SCALAR);
    }

}
