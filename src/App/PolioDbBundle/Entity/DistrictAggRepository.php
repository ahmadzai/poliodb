<?php
namespace App\PolioDbBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

class DistrictAggRepository extends EntityRepository {
    /***
     * @return array
     */
    public function selectAllDistrictAgg() {
        return $this->getEntityManager()
            ->createQuery(
                "SELECT d FROM AppPolioDbBundle:DistrictAgg d"
            )
            ->getResult(Query::HYDRATE_SCALAR);
    }

    public function selectDistrictAggByProvince($province) {
        return $this->getEntityManager()
            ->createQuery(
                "SELECT d FROM AppPolioDbBundle:DistrictAgg d WHERE d.provinceCode = :prov"
            ) ->setParameters(['prov'=>$province])
            ->getResult(Query::HYDRATE_SCALAR);
    }

    public function selectDistrictAggByProvinceMonths($province, $where) {
        return $this->getEntityManager()
            ->createQuery(
                "SELECT d FROM AppPolioDbBundle:DistrictAgg d WHERE d.provinceCode = :prov AND ($where)"
            ) ->setParameters(['prov'=>$province])
            ->getResult(Query::HYDRATE_SCALAR);
    }

    public function selectDistrictAggByProvinceCampaign($province, $campaign) {
        return $this->getEntityManager()
            ->createQuery(
                "SELECT d FROM AppPolioDbBundle:DistrictAgg d WHERE d.provinceCode = :prov AND (d.campaignId in (:camp))"
            ) ->setParameters(['prov'=>$province, 'camp'=>$campaign])
            ->getResult(Query::HYDRATE_SCALAR);
    }

    public function count2MonthsSubmissions($month1, $month2) {
        return $this->getEntityManager()
            ->createQuery(
                "SELECT s.form as legend, s.month as xAxis, COUNT(s.id) as yAxisse FROM AppPolioDbBundle:Submissions s 
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