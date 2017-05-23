<?php
namespace App\PolioDbBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

class ProvinceDataRepository extends EntityRepository {
    /***
     * @return array
     */
    public function selectAllProvinces() {
        return $this->getEntityManager()
            ->createQuery(
                "SELECT d FROM AppPolioDbBundle:ProvinceData d"
            )
            ->getResult(Query::HYDRATE_SCALAR);
    }

    /***
     * @param $region
     * @return array
     */
    public function selectProvincesByRegion($region) {
        return $this->getEntityManager()
            ->createQuery(
                "SELECT d FROM AppPolioDbBundle:ProvinceData d WHERE d.provinceRegion = :reg"
            ) ->setParameters(['reg'=>$region])
            ->getResult(Query::HYDRATE_SCALAR);
    }

    /***
     * @return array
     */
    public function selectAllRegions() {
        $data = $this->getEntityManager()
            ->createQuery(
                "SELECT d.provinceRegion FROM AppPolioDbBundle:ProvinceData d GROUP BY d.provinceRegion"
            )
            ->getResult(Query::HYDRATE_SCALAR);
        $ret_date = array();
        foreach($data as $d)
            $ret_date[] = $d['provinceRegion'];
        return $ret_date;
    }

}