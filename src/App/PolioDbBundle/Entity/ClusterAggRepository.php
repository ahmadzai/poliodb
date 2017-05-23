<?php
namespace App\PolioDbBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

class ClusterAggRepository extends EntityRepository {
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

    public function selectClusterDataByDistrict($district) {
        return $this->getEntityManager()
            ->createQuery(
                "SELECT d FROM AppPolioDbBundle:ClusterAgg d WHERE d.dcode = :dist"
            ) ->setParameters(['dist'=>$district])
            ->getResult(Query::HYDRATE_SCALAR);
    }

    public function selectClusterDataByDistrictMonths($district, $where) {
        return $this->getEntityManager()
            ->createQuery(
                "SELECT d FROM AppPolioDbBundle:ClusterAgg d WHERE d.dcode = :dist AND ($where)"
            ) ->setParameters(['dist'=>$district])
            ->getResult(Query::HYDRATE_SCALAR);
    }

    public function selectClusterDataByDistrictCampaign($district, $campaign) {
        return $this->getEntityManager()
            ->createQuery(
                "SELECT d FROM AppPolioDbBundle:ClusterAgg d WHERE d.dcode = :dist AND (d.campaignId IN (:camp))"
            ) ->setParameters(['dist'=>$district, 'camp' => $campaign])
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