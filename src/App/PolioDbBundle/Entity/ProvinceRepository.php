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

    public function selectAllRegions() {
        return $this->getEntityManager()
            ->createQuery(
                "SELECT DISTINCT p.provinceRegion as provinceRegion FROM AppPolioDbBundle:Province p ORDER BY p.provinceRegion"
            )
            ->getResult(Query::HYDRATE_SCALAR);
    }

    public function selectProvinceByRegion($region) {
        return $this->getEntityManager()
            ->createQuery(
                "SELECT DISTINCT p FROM AppPolioDbBundle:Province p WHERE p.provinceRegion IN (:region) ORDER BY p.provinceRegion"
            ) ->setParameter('region', $region)
              ->getResult(Query::HYDRATE_SCALAR);
    }

}
