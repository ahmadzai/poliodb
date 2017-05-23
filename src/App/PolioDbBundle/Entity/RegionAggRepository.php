<?php
namespace App\PolioDbBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

class RegionAggRepository extends EntityRepository {
    /***
     * @return array
     */
    public function selectAllRegionAgg() {
        return $this->getEntityManager()
            ->createQuery(
                "SELECT d FROM AppPolioDbBundle:RegionAgg d"
            )
            ->getResult(Query::HYDRATE_SCALAR);
    }

    public function selectAllRegionAggByWhere($where) {
        return $this->getEntityManager()
            ->createQuery(
                "SELECT d FROM AppPolioDbBundle:RegionAgg d WHERE $where"
            )
            ->getResult(Query::HYDRATE_SCALAR);
    }

    public function selectAllRegionAggByCampaign($campaign) {
        return $this->getEntityManager()
            ->createQuery(
                "SELECT d FROM AppPolioDbBundle:RegionAgg d WHERE d.campaignId in (:camp)"
            ) ->setParameters(['camp' => $campaign])
            ->getResult(Query::HYDRATE_SCALAR);
    }

    public function selectAllRegionVaccUsageByCampaign($campaign) {
        return $this->getEntityManager()
            ->createQuery(
                "SELECT d, ((d.usedVials * 20 - (d.child0To11+d.child12To59))/(d.usedVials * 20) * 100) as wastage
                 FROM AppPolioDbBundle:RegionAgg d WHERE d.campaignId in (:camp)"
            ) ->setParameters(['camp' => $campaign])
            ->getResult(Query::HYDRATE_SCALAR);
    }

    public function selectIndicatorRegionAggByCampaign($camp, $indicator, $as) {
        return $this->getEntityManager()
            ->createQuery(
                "SELECT d.* FROM AppPolioDbBundle:RegionAgg d WHERE d.campaignId = :camp"
            ) ->setParameters(['camp'=>$camp])
            ->getResult(Query::HYDRATE_SCALAR);
    }

    public function selectRegionAggByRegionCampaign($region, $year, $month) {
        return $this->getEntityManager()
            ->createQuery(
                "SELECT d FROM AppPolioDbBundle:RegionAgg d WHERE d.region = :reg AND 
                 d.cYear = :cYear AND d.cMonth = :cMonth "
            ) ->setParameters(['reg'=>$region, 'cYear'=>$year, 'cMonth'=> $month])
            ->getResult(Query::HYDRATE_SCALAR);
    }

    public function countRegionAggByCampaign($year, $month) {
        return $this->getEntityManager()
            ->createQuery(
                "SELECT count(d.id) as total FROM AppPolioDbBundle:RegionAgg d WHERE 
                 d.cYear = :c_year AND d.cMonth = :c_month "
            ) ->setParameters(['c_year'=>$year, 'c_month'=> $month])
            ->getResult(Query::HYDRATE_SINGLE_SCALAR);
    }
}