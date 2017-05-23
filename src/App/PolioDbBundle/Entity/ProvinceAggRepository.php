<?php
namespace App\PolioDbBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

class ProvinceAggRepository extends EntityRepository {
    /***
     * @return array
     */
    public function selectAllProvinceAgg() {
        return $this->getEntityManager()
            ->createQuery(
                "SELECT d FROM AppPolioDbBundle:ProvinceAgg d"
            )
            ->getResult(Query::HYDRATE_SCALAR);
    }

    public function selectProvinceAggByRegion($region) {
        return $this->getEntityManager()
            ->createQuery(
                "SELECT d FROM AppPolioDbBundle:ProvinceAgg d WHERE d.region = :reg"
            ) ->setParameters(['reg'=>$region])
            ->getResult(Query::HYDRATE_SCALAR);
    }

    public function selectProvinceAggByRegionMonths($region, $where) {
        return $this->getEntityManager()
            ->createQuery(
                "SELECT d FROM AppPolioDbBundle:ProvinceAgg d WHERE d.region = :reg AND ($where)"
            ) ->setParameters(['reg'=>$region])
            ->getResult(Query::HYDRATE_SCALAR);
    }

    public function selectProvinceAggByRegionCampaign($region, $campaign) {
        return $this->getEntityManager()
            ->createQuery(
                "SELECT d FROM AppPolioDbBundle:ProvinceAgg d WHERE d.region = :reg AND (d.campaignId in (:camp))"
            ) ->setParameters(['reg'=>$region, 'camp'=>$campaign])
            ->getResult(Query::HYDRATE_SCALAR);
    }

//    public function selectProvinceAggByRegionCampaign($region, $year, $month) {
//        return $this->getEntityManager()
//            ->createQuery(
//                "SELECT d FROM AppPolioDbBundle:ProvinceAgg d WHERE d.region = :reg AND
//                 d.cYear = :cyear AND d.cMonth = :cmonth "
//            ) ->setParameters(['reg'=>$region, 'cyear'=>$year, 'cmonth'=> $month])
//            ->getResult(Query::HYDRATE_SCALAR);
//    }

    public function selectLast3CampaignsData($month1, $month2) {
        return $this->getEntityManager()
            ->createQuery(
                "SELECT s.form as legend, s.month as xAxis, COUNT(s.id) as yAxis FROM AppPolioDbBundle:Submissions s 
                 WHERE (s.month = :month1 OR s.month = :month2)
                 GROUP BY s.form, s.month ORDER BY s.date"
            ) ->setParameters(['month1'=>$month1, 'month2'=>$month2])
            ->getResult();
    }

    public function countAllSubmissionsBy($type) {
        return $this->getEntityManager()
            ->createQuery(
                "SELECT s.$type as legend, COUNT(s.id) as total FROM AppPolioDbBundle:Submissions s 
                 GROUP BY s.$type"
            ) ->getResult();
    }
}