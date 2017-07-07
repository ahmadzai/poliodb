<?php
namespace App\PolioDbBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

class AdminDataRepository extends EntityRepository {

    public function monthsYear($count = 4, $type = 'all') {
        $curr_y = date('Y');
        $curr_m = date('F');
        $data = $this->getEntityManager()
            ->createQuery(
                "SELECT d.cYear, d.cMonth, d.campaignDate FROM AppPolioDbBundle:RegionAgg d
                 GROUP BY d.cYear, d.cMonth ORDER BY d.campaignDate DESC"
            )
            ->getResult(Query::HYDRATE_SCALAR);
        $months_years = array();
        $where = "";
        if(count($data) > 0 && count($data) >= $count)
            for($i = 0; $i < $count; $i ++) {
                $months_years[$data[$i]['cMonth']] = $data[$i]['cYear'];
                $where .= "(d.cYear = ".$data[$i]['cYear']." and d.cMonth = '".$data[$i]['cMonth']."') ";
                if($i < $count-1)
                    $where .= "OR ";
            }

        return $where;
    }

    // Below are the functions to be used instead of database Views

    public function adminDataAllByDay($day) {
        return $this->getEntityManager()
            ->createQuery(
                "SELECT p.provinceRegion, p.provinceName, d.districtName, adm.targetPopulation, adm.regRefusal, adm.vaccRefusal, adm.refusal, cmp.campaignType
                  FROM AppPolioDbBundle:AdminData adm JOIN adm.campaign cmp
                  JOIN adm.districtCode d JOIN d.provinceCode p WHERE(adm.vaccDay = :vacDay)"
            )-> setParameters(['vacDay'=>$day])
            ->getResult(Query::HYDRATE_SCALAR);
    }

    public function clusterAgg($campaign, $district) {
        return $this->getEntityManager()
            ->createQuery(
                "SELECT adm.id as id, p.provinceRegion, p.provinceName, p.provinceCode, d.districtName,
                  d.districtCode, d.districtLpdStatus, adm.subDistrictName, adm.cluster,
                  cmp.campaignStartDate, cmp.campaignType, cmp.campaignYear, cmp.campaignMonth, adm.targetPopulation,
                  sum(adm.receivedVials) as receivedVials, sum(adm.usedVials) as usedVials,
                  sum(adm.targetPopulation) as TargetPopulation,
                  sum(
                    CASE
                      WHEN (adm.vaccDay = 1 OR adm.vaccDay = 2 OR adm.vaccDay = 3)
                      THEN adm.regAbsent ELSE 0
                    END
                  ) as regAbsent,
                  sum(adm.vaccAbsent) as vaccAbsent,
                  sum(CASE WHEN adm.vaccDay = 4 THEN adm.missed ELSE 0 END) as remainingAbsent,
                  sum(
                    CASE
                      WHEN (adm.vaccDay = 1 OR adm.vaccDay = 2 OR adm.vaccDay = 3)
                      THEN adm.regRefusal ELSE 0
                    END
                  ) as RegRefusal,
                  sum(CASE WHEN adm.vaccDay = 4 THEN adm.refusal ELSE 0 END ) as Refusal,

                  cmp.campaignType
                  FROM AppPolioDbBundle:AdminData adm JOIN adm.campaign cmp
                  JOIN adm.districtCode d JOIN d.provinceCode p WHERE(adm.campaign IN (:camp) AND adm.districtCode = :dist)
                  GROUP BY d.districtCode, adm.subDistrictName, cmp.campaignId, adm.cluster"
            )-> setParameters(['camp'=>$campaign, 'dist'=>$district])
            ->getResult(Query::HYDRATE_SCALAR);
    }

    public function districtAgg($campaign) {
        return $this->getEntityManager()
            ->createQuery(
                "SELECT p.provinceRegion, p.provinceName, d.districtName,
                  sum(adm.targetPopulation) as TargetPopulation,
                  sum(
                    CASE
                      WHEN (adm.vaccDay = 1 OR adm.vaccDay = 2 OR adm.vaccDay = 3)
                      THEN adm.regRefusal ELSE 0
                    END
                  ) as RegRefusal,
                  sum(CASE WHEN adm.vaccDay = 4 THEN adm.refusal ELSE 0 END ) as Refusal,

                  cmp.campaignType
                  FROM AppPolioDbBundle:AdminData adm JOIN adm.campaign cmp
                  JOIN adm.districtCode d JOIN d.provinceCode p WHERE(adm.campaign = :camp)
                  GROUP BY p.provinceRegion, p.provinceName, d.districtCode"
            )-> setParameters(['camp'=>$campaign])
            ->getResult(Query::HYDRATE_SCALAR);
    }

    public function provinceAgg($campaign) {
        return $this->getEntityManager()
            ->createQuery(
                "SELECT p.provinceRegion, p.provinceName, p.provinceCode,
                  sum(adm.targetPopulation) as TargetPopulation,
                  sum(
                    CASE
                      WHEN (adm.vaccDay = 1 OR adm.vaccDay = 2 OR adm.vaccDay = 3)
                      THEN adm.regRefusal ELSE 0
                    END
                  ) as RegRefusal,
                  sum(CASE WHEN adm.vaccDay = 4 THEN adm.refusal ELSE 0 END ) as Refusal,

                  cmp.campaignType
                  FROM AppPolioDbBundle:AdminData adm JOIN adm.campaign cmp
                  JOIN adm.districtCode d JOIN d.provinceCode p WHERE(adm.campaign = :camp)
                  GROUP BY p.provinceRegion, p.provinceName"
            )-> setParameters(['camp'=>$campaign])
            ->getResult(Query::HYDRATE_SCALAR);
    }

    public function regionAgg($campaign) {
        return $this->getEntityManager()
            ->createQuery(
                "SELECT p.provinceRegion as Region, cmp.campaignStartDate as CDate,
                  cmp.campaignType as CType, cmp.campaignYear as CYear, cmp.campaignMonth as CMonth,
                  sum(adm.targetPopulation) as TargetChild, sum(adm.receivedVials) as RVials, sum(adm.usedVials) as UVials,
                  ((sum(adm.usedVials)*20 - sum(adm.child011+adm.child1259+adm.vaccAbsent+adm.vaccSleep+adm.vaccRefusal))/(sum(adm.usedVials)*20) * 100) as VaccWastage,
                  sum(adm.targetPopulation) as TargetPopulation,
                  sum(adm.child011+adm.child1259+adm.vaccAbsent+adm.vaccSleep+adm.vaccRefusal) as VaccChild,

                  sum(
                    CASE
                      WHEN (adm.vaccDay = 1 OR adm.vaccDay = 2 OR adm.vaccDay = 3)
                      THEN adm.regAbsent ELSE 0
                    END
                  ) as RegAbsent,
                  sum(adm.vaccAbsent) as VaccAbsent,
                  sum(CASE WHEN adm.vaccDay = 4 THEN adm.missed ELSE 0 END ) as RemainingAbsent,

                  sum(
                    CASE
                      WHEN (adm.vaccDay = 1 OR adm.vaccDay = 2 OR adm.vaccDay = 3)
                      THEN adm.regSleep ELSE 0
                    END
                  ) as RegNSS,
                  sum(adm.vaccSleep) as VaccNSS,
                  sum(CASE WHEN adm.vaccDay = 4 THEN adm.sleep ELSE 0 END ) as RemainingNSS,

                  sum(
                    CASE
                      WHEN (adm.vaccDay = 1 OR adm.vaccDay = 2 OR adm.vaccDay = 3)
                      THEN adm.regRefusal ELSE 0
                    END
                  ) as RegRefusal,
                  sum(adm.vaccRefusal) as VaccRefusal,
                  sum(CASE WHEN adm.vaccDay = 4 THEN adm.refusal ELSE 0 END ) as RemainingRefusal,

                  sum(adm.missed + adm.sleep + adm.refusal) as TotalRemaining
                  FROM AppPolioDbBundle:AdminData adm JOIN adm.campaign cmp
                  JOIN adm.districtCode d JOIN d.provinceCode p WHERE(adm.campaign in (:camp))
                  GROUP BY p.provinceRegion, CYear, CMonth"
            )-> setParameters(['camp'=>$campaign])
            ->getResult(Query::HYDRATE_SCALAR);
    }

    public function checkThreeDayCampaign()
    {
      $em = $this->getEntityManager();
      $repository = $em->getRepository('AppPolioDbBundle:AdminData');

      // createQueryBuilder() automatically selects FROM AppBundle:Product
      // and aliases it to "p"
      $query = $repository->createQueryBuilder('p')
      ->where('p.campaign = 14')
      ->andWhere('p.vaccDay = 1 OR p.vaccDay = 2 OR p.vaccDay = 3')
      ->getQuery();


return $query->getResult();
    }

}
