<?php
namespace App\PolioDbBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

class DistrictDataRepository extends EntityRepository {
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

    /***
     * @param $province_code
     * @return array
     */
    public function selectDistrictsByProvince($province_code) {
        return $this->getEntityManager()
            ->createQuery(
                "SELECT d FROM AppPolioDbBundle:DistrictData d WHERE d.provinceCode = :pCode ORDER BY d.districtCode ASC "
            ) ->setParameters(['pCode'=>$province_code])
            ->getResult(Query::HYDRATE_SCALAR);
    }

    /***
     * @param $province_code
     * @return array
     */
    public function selectLpdDistrictsByProvince($province_code) {
        return $this->getEntityManager()
            ->createQuery(
                "SELECT d FROM AppPolioDbBundle:DistrictData d WHERE d.provinceCode = :pCode 
                 AND d.lpdStatus IN (1, 2, 3) ORDER BY d.lpdStatus, d.districtCode ASC "
            ) ->setParameters(['pCode'=>$province_code])
            ->getResult(Query::HYDRATE_SCALAR);
    }

}