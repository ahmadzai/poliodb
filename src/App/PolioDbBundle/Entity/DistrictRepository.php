<?php
namespace App\PolioDbBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

class DistrictRepository extends EntityRepository {

    public function selectDistrictByProvince($province) {
        return $this->getEntityManager()
            ->createQuery(
                "SELECT d, p.provinceCode, p.provinceName FROM AppPolioDbBundle:District d JOIN d.provinceCode p WHERE d.provinceCode IN (:province) ORDER BY d.provinceCode"
            ) ->setParameter('province', $province)
              ->getResult(Query::HYDRATE_SCALAR);
    }

}
