<?php
namespace App\PolioDbBundle\Entity;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
class AdminDataRepository extends EntityRepository {
    /**
     * @param $function the function must be pre-defined
     * @param $parameters the parameters must be defined in the function
     * @param null $secondParam
     * @return mixed
     */
    public function callMe($function, $parameters, $secondParam = null) {
        return call_user_func(array($this, $function), $parameters, $secondParam);
    }
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
    public function campaignStatistics($campaign) {
        return $this->getEntityManager()
            ->createQuery("SELECT cmp.campaignId as CID, cmp.campaignStartDate as CDate,
                  cmp.campaignType as CType, cmp.campaignYear as CYear, cmp.campaignMonth as CMonth,
                  sum(adm.receivedVials) as RVials, sum(adm.usedVials) as UVials,
                  ((sum(adm.usedVials)*20 - (sum(adm.child011)+sum(adm.child1259)+sum(adm.vaccAbsent)+sum(adm.vaccSleep)+sum(adm.vaccRefusal)))/(sum(adm.usedVials)*20) * 100) as VaccWastage,
                  sum(adm.targetPopulation)/4 as TargetPopulation,
                  sum(adm.child011)+SUM(adm.child1259)+sum(adm.vaccAbsent)+sum(adm.vaccSleep)+sum(adm.vaccRefusal) as VaccChild,
                  sum(adm.child011) as Child011, sum(adm.child1259) as Child1259,
                  sum(adm.vaccAbsent)+sum(adm.vaccSleep)+sum(adm.vaccRefusal) as MissedVaccinated,
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
                  FROM AppPolioDbBundle:AdminData adm JOIN adm.campaign cmp WHERE(adm.campaign=:camp)") ->setParameter('camp', $campaign)
            ->getResult(Query::HYDRATE_SCALAR);
    }
    /**
     * @param $campaign
     * @param $district
     * @return array
     */
    public function clusterAgg($campaign, $district) {
        return $this->getEntityManager()
            ->createQuery(
                "SELECT p.provinceRegion as Region, p.provinceName as Province, d.districtName as District, d.districtCode as DCODE, cmp.campaignStartDate as CDate, cmp.campaignId as CID,
                  cmp.campaignType as CType, cmp.campaignYear as CYear, cmp.campaignMonth as CMonth, adm.subDistrictName as SubDistrict, adm.clusterName as ClusterName, adm.clusterNo as ClusterNo,
                  sum(adm.receivedVials) as RVials, sum(adm.usedVials) as UVials,
                  ((sum(adm.usedVials)*20 - (sum(adm.child011)+sum(adm.child1259)+sum(adm.vaccAbsent)+sum(adm.vaccSleep)+sum(adm.vaccRefusal)))/(sum(adm.usedVials)*20) * 100) as VaccWastage,
                  sum(adm.targetPopulation)/4 as TargetPopulation,
                  sum(adm.child011)+SUM(adm.child1259)+sum(adm.vaccAbsent)+sum(adm.vaccSleep)+sum(adm.vaccRefusal) as VaccChild,
                  sum(adm.child011) as Child011, sum(adm.child1259) as Child1259,
                  sum(adm.vaccAbsent)+sum(adm.vaccSleep)+sum(adm.vaccRefusal) as MissedVaccinated,
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
                  JOIN adm.districtCode d JOIN d.provinceCode p WHERE(adm.campaign in (:camp) and adm.districtCode in (:dist))
                  GROUP BY cmp.campaignId, d.districtCode, adm.subDistrictName, adm.cluster"
            )-> setParameters(['camp'=>$campaign, 'dist'=>$district])
            ->getResult(Query::HYDRATE_SCALAR);
    }
    /**
     * @param $campaign
     * @return array
     */
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
    /**
     * @param $campaign
     * @return array
     */
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
    /**
     * @param $campaign
     * @return array
     */
    public function districtAggByCampaign($campaign) {
        return $this->getEntityManager()
            ->createQuery(
                "SELECT p.provinceRegion as Region, p.provinceName as Province, d.districtName as District, d.districtCode as DCODE, cmp.campaignStartDate as CDate, cmp.campaignId as CID,
                  cmp.campaignType as CType, cmp.campaignYear as CYear, cmp.campaignMonth as CMonth,
                  sum(adm.receivedVials) as RVials, sum(adm.usedVials) as UVials,
                  ((sum(adm.usedVials)*20 - (sum(adm.child011)+sum(adm.child1259)+sum(adm.vaccAbsent)+sum(adm.vaccSleep)+sum(adm.vaccRefusal)))/(sum(adm.usedVials)*20) * 100) as VaccWastage,
                  sum(adm.targetPopulation)/4 as TargetPopulation,
                  sum(adm.child011)+SUM(adm.child1259)+sum(adm.vaccAbsent)+sum(adm.vaccSleep)+sum(adm.vaccRefusal) as VaccChild,
                  sum(adm.child011) as Child011, sum(adm.child1259) as Child1259,
                  sum(adm.vaccAbsent)+sum(adm.vaccSleep)+sum(adm.vaccRefusal) as MissedVaccinated,
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
                  GROUP BY p.provinceCode, adm.districtCode, adm.campaign"
            )-> setParameters(['camp'=>$campaign])
            ->getResult(Query::HYDRATE_SCALAR);
    }
    /**
     * @param $campaign
     * @param $district
     * @return array
     */
    public function districtAggByCampaignDistrict($campaign, $district) {
        return $this->getEntityManager()
            ->createQuery(
                "SELECT p.provinceRegion as Region, p.provinceName as Province, d.districtName as District, d.districtCode as DCODE, cmp.campaignStartDate as CDate, cmp.campaignId as CID,
                  cmp.campaignType as CType, cmp.campaignYear as CYear, cmp.campaignMonth as CMonth,
                  sum(adm.receivedVials) as RVials, sum(adm.usedVials) as UVials,
                  ((sum(adm.usedVials)*20 - (sum(adm.child011)+sum(adm.child1259)+sum(adm.vaccAbsent)+sum(adm.vaccSleep)+sum(adm.vaccRefusal)))/(sum(adm.usedVials)*20) * 100) as VaccWastage,
                  sum(adm.targetPopulation)/4 as TargetPopulation,
                  sum(adm.child011)+SUM(adm.child1259)+sum(adm.vaccAbsent)+sum(adm.vaccSleep)+sum(adm.vaccRefusal) as VaccChild,
                  sum(adm.child011) as Child011, sum(adm.child1259) as Child1259,
                  sum(adm.vaccAbsent)+sum(adm.vaccSleep)+sum(adm.vaccRefusal) as MissedVaccinated,
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
                  JOIN adm.districtCode d JOIN d.provinceCode p WHERE(adm.campaign in (:camp) AND adm.districtCode in (:dist))
                  GROUP BY p.provinceCode, adm.districtCode, adm.campaign"
            )-> setParameters(['camp'=>$campaign, 'dist'=>$district])
            ->getResult(Query::HYDRATE_SCALAR);
    }
    public function districtAggByCampaignDistrictRisk($campaign, $risk)  {
        $prov = $risk['province'];
        $risk = $risk['risk'];
        return $this->getEntityManager()
            ->createQuery(
                "SELECT p.provinceRegion as Region, p.provinceName as Province, d.districtName as District, d.districtCode as DCODE, cmp.campaignStartDate as CDate, cmp.campaignId as CID,
                  cmp.campaignType as CType, cmp.campaignYear as CYear, cmp.campaignMonth as CMonth,
                  sum(adm.receivedVials) as RVials, sum(adm.usedVials) as UVials,
                  ((sum(adm.usedVials)*20 - (sum(adm.child011)+sum(adm.child1259)+sum(adm.vaccAbsent)+sum(adm.vaccSleep)+sum(adm.vaccRefusal)))/(sum(adm.usedVials)*20) * 100) as VaccWastage,
                  sum(adm.targetPopulation)/4 as TargetPopulation,
                  sum(adm.child011)+SUM(adm.child1259)+sum(adm.vaccAbsent)+sum(adm.vaccSleep)+sum(adm.vaccRefusal) as VaccChild,
                  sum(adm.child011) as Child011, sum(adm.child1259) as Child1259,
                  sum(adm.vaccAbsent)+sum(adm.vaccSleep)+sum(adm.vaccRefusal) as MissedVaccinated,
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
                  JOIN adm.districtCode d JOIN d.provinceCode p WHERE(adm.campaign in (:camp) AND p.provinceCode in (:prov) AND (d.districtRiskStatus in (:risk)))
                  GROUP BY p.provinceCode, adm.districtCode, adm.campaign"
            )-> setParameters(['camp'=>$campaign, 'risk'=>$risk, 'prov'=>$prov])
            ->getResult(Query::HYDRATE_SCALAR);
    }
    public function districtAggByCampaignDistrictRiskNull($campaign, $risk)  {
        $prov = $risk['province'];
        $risk = $risk['risk'];
        return $this->getEntityManager()
            ->createQuery(
                "SELECT p.provinceRegion as Region, p.provinceName as Province, d.districtName as District, d.districtCode as DCODE, cmp.campaignStartDate as CDate, cmp.campaignId as CID,
                  cmp.campaignType as CType, cmp.campaignYear as CYear, cmp.campaignMonth as CMonth,
                  sum(adm.receivedVials) as RVials, sum(adm.usedVials) as UVials,
                  ((sum(adm.usedVials)*20 - (sum(adm.child011)+sum(adm.child1259)+sum(adm.vaccAbsent)+sum(adm.vaccSleep)+sum(adm.vaccRefusal)))/(sum(adm.usedVials)*20) * 100) as VaccWastage,
                  sum(adm.targetPopulation)/4 as TargetPopulation,
                  sum(adm.child011)+SUM(adm.child1259)+sum(adm.vaccAbsent)+sum(adm.vaccSleep)+sum(adm.vaccRefusal) as VaccChild,
                  sum(adm.child011) as Child011, sum(adm.child1259) as Child1259,
                  sum(adm.vaccAbsent)+sum(adm.vaccSleep)+sum(adm.vaccRefusal) as MissedVaccinated,
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
                  JOIN adm.districtCode d JOIN d.provinceCode p WHERE(adm.campaign in (:camp) AND p.provinceCode in (:prov)
                  AND (d.districtRiskStatus in (:risk) OR d.districtRiskStatus IS NULL))
                  GROUP BY p.provinceCode, adm.districtCode, adm.campaign"
            )-> setParameters(['camp'=>$campaign, 'risk'=>$risk, 'prov'=>$prov])
            ->getResult(Query::HYDRATE_SCALAR);
    }
    /**
     * @param $campaign
     * @return array
     */
    public function provinceAggByCampaign($campaign) {
        return $this->getEntityManager()
            ->createQuery(
                "SELECT p.provinceRegion as Region, p.provinceCode as PCODE, p.provinceName as Province, cmp.campaignStartDate as CDate, cmp.campaignId as CID,
                  cmp.campaignType as CType, cmp.campaignYear as CYear, cmp.campaignMonth as CMonth,
                  sum(adm.receivedVials) as RVials, sum(adm.usedVials) as UVials,
                  ((sum(adm.usedVials)*20 - (sum(adm.child011)+sum(adm.child1259)+sum(adm.vaccAbsent)+sum(adm.vaccSleep)+sum(adm.vaccRefusal)))/(sum(adm.usedVials)*20) * 100) as VaccWastage,
                  sum(adm.targetPopulation)/4 as TargetPopulation,
                  sum(adm.child011)+SUM(adm.child1259)+sum(adm.vaccAbsent)+sum(adm.vaccSleep)+sum(adm.vaccRefusal) as VaccChild,
                  sum(adm.child011) as Child011, sum(adm.child1259) as Child1259,
                  sum(adm.vaccAbsent)+sum(adm.vaccSleep)+sum(adm.vaccRefusal) as MissedVaccinated,
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
                  GROUP BY p.provinceCode, adm.campaign"
            )-> setParameters(['camp'=>$campaign])
            ->getResult(Query::HYDRATE_SCALAR);
    }
    /**
     * @param $campaign
     * @param $province
     * @return array
     */
    public function provinceAggByCampaignProvince($campaign, $province) {
        return $this->getEntityManager()
            ->createQuery(
                "SELECT p.provinceRegion as Region, p.provinceCode as PCODE, p.provinceName as Province, cmp.campaignStartDate as CDate, cmp.campaignId as CID,
                  cmp.campaignType as CType, cmp.campaignYear as CYear, cmp.campaignMonth as CMonth,
                  sum(adm.receivedVials) as RVials, sum(adm.usedVials) as UVials,
                  ((sum(adm.usedVials)*20 - (sum(adm.child011)+sum(adm.child1259)+sum(adm.vaccAbsent)+sum(adm.vaccSleep)+sum(adm.vaccRefusal)))/(sum(adm.usedVials)*20) * 100) as VaccWastage,
                  sum(adm.targetPopulation)/4 as TargetPopulation,
                  sum(adm.child011)+SUM(adm.child1259)+sum(adm.vaccAbsent)+sum(adm.vaccSleep)+sum(adm.vaccRefusal) as VaccChild,
                  sum(adm.child011) as Child011, sum(adm.child1259) as Child1259,
                  sum(adm.vaccAbsent)+sum(adm.vaccSleep)+sum(adm.vaccRefusal) as MissedVaccinated,
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
                  JOIN adm.districtCode d JOIN d.provinceCode p WHERE(adm.campaign in (:camp) AND p.provinceCode in (:prov))
                  GROUP BY p.provinceCode, adm.campaign"
            )-> setParameters(['camp'=>$campaign, 'prov'=>$province])
            ->getResult(Query::HYDRATE_SCALAR);
    }
    /**
     * @param $campaign
     * @return array
     */
    public function regionAgg($campaign) {
        return $this->getEntityManager()
            ->createQuery(
                "SELECT p.provinceRegion as Region, cmp.campaignStartDate as CDate, cmp.campaignId as CID,
                  cmp.campaignType as CType, cmp.campaignYear as CYear, cmp.campaignMonth as CMonth,
                  sum(adm.receivedVials) as RVials, sum(adm.usedVials) as UVials,
                  ((sum(adm.usedVials)*20 - (sum(adm.child011)+sum(adm.child1259)+sum(adm.vaccAbsent)+sum(adm.vaccSleep)+sum(adm.vaccRefusal)))/(sum(adm.usedVials)*20) * 100) as VaccWastage,
                  sum(adm.targetPopulation)/4 as TargetPopulation,
                  sum(adm.child011)+SUM(adm.child1259)+sum(adm.vaccAbsent)+sum(adm.vaccSleep)+sum(adm.vaccRefusal) as VaccChild,
                  sum(adm.child011) as Child011, sum(adm.child1259) as Child1259,
                  sum(adm.vaccAbsent)+sum(adm.vaccSleep)+sum(adm.vaccRefusal) as MissedVaccinated,
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
                  GROUP BY p.provinceRegion, adm.campaign"
            )-> setParameters(['camp'=>$campaign])
            ->getResult(Query::HYDRATE_SCALAR);
    }


    public function checkThreeDayCampaign($campaignday)
    {
      $em = $this->getEntityManager();
      $repository = $em->getRepository('AppPolioDbBundle:AdminData');

      // createQueryBuilder() automatically selects FROM AppBundle:Product
      // and aliases it to "p"
      $query = $repository->createQueryBuilder('p')
      ->where('p.campaign= :campid')
      ->andWhere('p.vaccDay = 1 OR p.vaccDay = 2 OR p.vaccDay = 3')
      ->setParameter('campid', $campaignday)
      ->getQuery();


      return $query->getResult();
    }

    /**
     * @param $campaign
     * @param $region
     * @return array
     */
    public function regionAggByCampaignRegion($campaign, $region) {
        return $this->getEntityManager()
            ->createQuery(
                "SELECT p.provinceRegion as Region, cmp.campaignStartDate as CDate, cmp.campaignId as CID,
                  cmp.campaignType as CType, cmp.campaignYear as CYear, cmp.campaignMonth as CMonth,
                  sum(adm.receivedVials) as RVials, sum(adm.usedVials) as UVials,
                  ((sum(adm.usedVials)*20 - (sum(adm.child011)+sum(adm.child1259)+sum(adm.vaccAbsent)+sum(adm.vaccSleep)+sum(adm.vaccRefusal)))/(sum(adm.usedVials)*20) * 100) as VaccWastage,
                  sum(adm.targetPopulation)/4 as TargetPopulation,
                  sum(adm.child011)+SUM(adm.child1259)+sum(adm.vaccAbsent)+sum(adm.vaccSleep)+sum(adm.vaccRefusal) as VaccChild,
                  sum(adm.child011) as Child011, sum(adm.child1259) as Child1259,
                  sum(adm.vaccAbsent)+sum(adm.vaccSleep)+sum(adm.vaccRefusal) as MissedVaccinated,
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
                  JOIN adm.districtCode d JOIN d.provinceCode p WHERE(adm.campaign in (:camp) AND p.provinceRegion in (:region))
                  GROUP BY p.provinceRegion, adm.campaign"
            )-> setParameters(['camp'=>$campaign, 'region'=>$region])
            ->getResult(Query::HYDRATE_SCALAR);

    }

    /**
     * @param $region
     * @return array
     */
    public function selectRegion($region) {

      return $this->getEntityManager()
          ->createQuery(
            "SELECT adm.id as ID, p.provinceRegion as Region, p.provinceName as Province, d.districtName as District, adm.subDistrictName as SDistrict, adm.cluster as Cluster,
            c.campaignName as CName, c.campaignType as CType, c.campaignMonth as CMonth, c.campaignYear as CYear, adm.receivedVials as ReceivedVials
            , adm.usedVials as UsedVials, adm.child011 as Child011, adm.child1259 as Child1259, adm.regAbsent as RegAbsent, adm.vaccAbsent as VaccAbsent, adm.missed as RemainingAbsent,
            adm.regSleep as RegSleep
            , adm.vaccSleep as VaccSleep, adm.sleep as RemainingSleep, adm.regRefusal as RegRefusal, adm.vaccRefusal as VaccRefusal, adm.refusal as RemainingRefusal, adm.vaccDay as VaccDay
                FROM AppPolioDbBundle:AdminData adm JOIN adm.campaign c JOIN adm.districtCode d JOIN d.provinceCode p WHERE p.provinceRegion in (:regio) ORDER BY p.provinceRegion, p.provinceName, d.districtName, adm.cluster, adm.vaccDay"
          )-> setParameters(['regio'=>$region])
          ->getResult(Query::HYDRATE_SCALAR);
    }

    /**
     * @param $province
     * @return array
     */
    public function selectProvince($province) {

      return $this->getEntityManager()
          ->createQuery(
            "SELECT adm.id as ID, p.provinceRegion as Region, p.provinceName as Province, d.districtName as District, adm.subDistrictName as SDistrict, adm.cluster as Cluster,
            c.campaignName as CName, c.campaignType as CType, c.campaignMonth as CMonth, c.campaignYear as CYear, adm.receivedVials as ReceivedVials
            , adm.usedVials as UsedVials, adm.child011 as Child011, adm.child1259 as Child1259, adm.regAbsent as RegAbsent, adm.vaccAbsent as VaccAbsent, adm.missed as RemainingAbsent,
            adm.regSleep as RegSleep
            , adm.vaccSleep as VaccSleep, adm.sleep as RemainingSleep, adm.regRefusal as RegRefusal, adm.vaccRefusal as VaccRefusal, adm.refusal as RemainingRefusal, adm.vaccDay as VaccDay
                FROM AppPolioDbBundle:AdminData adm JOIN adm.campaign c JOIN adm.districtCode d JOIN d.provinceCode p WHERE p.provinceCode in (:prov) ORDER BY p.provinceRegion, p.provinceName, d.districtName, adm.cluster, adm.vaccDay"
          )-> setParameters(['prov'=>$province])
          ->getResult(Query::HYDRATE_SCALAR);
    }

    /**
     * @param $district
     * @return array
     */
    public function selectDistrict($district) {

      return $this->getEntityManager()
          ->createQuery(
            "SELECT adm.id as ID, p.provinceRegion as Region, p.provinceName as Province, d.districtName as District, adm.subDistrictName as SDistrict, adm.cluster as Cluster,
            c.campaignName as CName, c.campaignType as CType, c.campaignMonth as CMonth, c.campaignYear as CYear, adm.receivedVials as ReceivedVials
            , adm.usedVials as UsedVials, adm.child011 as Child011, adm.child1259 as Child1259, adm.regAbsent as RegAbsent, adm.vaccAbsent as VaccAbsent, adm.missed as RemainingAbsent,
            adm.regSleep as RegSleep
            , adm.vaccSleep as VaccSleep, adm.sleep as RemainingSleep, adm.regRefusal as RegRefusal, adm.vaccRefusal as VaccRefusal, adm.refusal as RemainingRefusal, adm.vaccDay as VaccDay
                FROM AppPolioDbBundle:AdminData adm JOIN adm.campaign c JOIN adm.districtCode d JOIN d.provinceCode p WHERE d.districtCode in (:dist) ORDER BY p.provinceRegion, p.provinceName, d.districtName, adm.cluster, adm.vaccDay"
          )-> setParameters(['dist'=>$district])
          ->getResult(Query::HYDRATE_SCALAR);
    }

    /**
     * @param $campaign
     * @return array
     */
    public function selectCampaign($campaign) {

      return $this->getEntityManager()
          ->createQuery(
            "SELECT adm.id as ID, p.provinceRegion as Region, p.provinceName as Province, d.districtName as District, adm.subDistrictName as SDistrict, adm.cluster as Cluster,
            c.campaignName as CName, c.campaignType as CType, c.campaignMonth as CMonth, c.campaignYear as CYear, adm.receivedVials as ReceivedVials
            , adm.usedVials as UsedVials, adm.child011 as Child011, adm.child1259 as Child1259, adm.regAbsent as RegAbsent, adm.vaccAbsent as VaccAbsent, adm.missed as RemainingAbsent,
            adm.regSleep as RegSleep
            , adm.vaccSleep as VaccSleep, adm.sleep as RemainingSleep, adm.regRefusal as RegRefusal, adm.vaccRefusal as VaccRefusal, adm.refusal as RemainingRefusal, adm.vaccDay as VaccDay
                FROM AppPolioDbBundle:AdminData adm JOIN adm.campaign c JOIN adm.districtCode d JOIN d.provinceCode p WHERE c.campaignId in (:camp) ORDER BY p.provinceRegion, p.provinceName, d.districtName, adm.cluster, adm.vaccDay"
          )-> setParameters(['camp'=>$campaign])
          ->getResult(Query::HYDRATE_SCALAR);
    }

    /**
     * @param $region
     * @param $campaign
     * @return array
     */

    public function regionByCampaigns($region, $campaign) {

      return $this->getEntityManager()
          ->createQuery(
            "SELECT adm.id as ID, p.provinceRegion as Region, p.provinceName as Province, d.districtName as District, adm.subDistrictName as SDistrict, adm.cluster as Cluster,
            c.campaignName as CName, c.campaignType as CType, c.campaignMonth as CMonth, c.campaignYear as CYear, adm.receivedVials as ReceivedVials
            , adm.usedVials as UsedVials, adm.child011 as Child011, adm.child1259 as Child1259, adm.regAbsent as RegAbsent, adm.vaccAbsent as VaccAbsent, adm.missed as RemainingAbsent,
            adm.regSleep as RegSleep
            , adm.vaccSleep as VaccSleep, adm.sleep as RemainingSleep, adm.regRefusal as RegRefusal, adm.vaccRefusal as VaccRefusal, adm.refusal as RemainingRefusal, adm.vaccDay as VaccDay
                FROM AppPolioDbBundle:AdminData adm JOIN adm.districtCode d JOIN d.provinceCode p JOIN adm.campaign c WHERE c.campaignId in (:camp) AND p.provinceRegion in (:regio) ORDER BY p.provinceRegion, p.provinceName, d.districtName, adm.cluster, adm.vaccDay"
          )-> setParameters(['camp'=>$campaign, 'regio'=>$region])
          ->getResult(Query::HYDRATE_SCALAR);
    }

    /**
     * @param $province
     * @param $campaign
     * @return array
     */
    public function provinceByCampaigns($province, $campaign) {

      return $this->getEntityManager()
          ->createQuery(
            "SELECT adm.id as ID, p.provinceRegion as Region, p.provinceName as Province, d.districtName as District, adm.subDistrictName as SDistrict, adm.cluster as Cluster,
            c.campaignName as CName, c.campaignType as CType, c.campaignMonth as CMonth, c.campaignYear as CYear, adm.receivedVials as ReceivedVials
            , adm.usedVials as UsedVials, adm.child011 as Child011, adm.child1259 as Child1259, adm.regAbsent as RegAbsent, adm.vaccAbsent as VaccAbsent, adm.missed as RemainingAbsent,
            adm.regSleep as RegSleep
            , adm.vaccSleep as VaccSleep, adm.sleep as RemainingSleep, adm.regRefusal as RegRefusal, adm.vaccRefusal as VaccRefusal, adm.refusal as RemainingRefusal, adm.vaccDay as VaccDay
                FROM AppPolioDbBundle:AdminData adm JOIN adm.districtCode d JOIN d.provinceCode p JOIN adm.campaign c WHERE c.campaignId in (:camp) AND p.provinceCode in (:prov) ORDER BY p.provinceRegion, p.provinceName, d.districtName, adm.cluster, adm.vaccDay"
          )-> setParameters(['camp'=>$campaign, 'prov'=>$province])
          ->getResult(Query::HYDRATE_SCALAR);
    }

    /**
     * @param $district
     * @param $campaign
     * @return array
     */
    public function districtByCampaigns($district, $campaign) {

      return $this->getEntityManager()
          ->createQuery(
            "SELECT adm.id as ID, p.provinceRegion as Region, p.provinceName as Province, d.districtName as District, adm.subDistrictName as SDistrict, adm.cluster as Cluster,
            c.campaignName as CName, c.campaignType as CType, c.campaignMonth as CMonth, c.campaignYear as CYear, adm.receivedVials as ReceivedVials
            , adm.usedVials as UsedVials, adm.child011 as Child011, adm.child1259 as Child1259, adm.regAbsent as RegAbsent, adm.vaccAbsent as VaccAbsent, adm.missed as RemainingAbsent,
            adm.regSleep as RegSleep
            , adm.vaccSleep as VaccSleep, adm.sleep as RemainingSleep, adm.regRefusal as RegRefusal, adm.vaccRefusal as VaccRefusal, adm.refusal as RemainingRefusal, adm.vaccDay as VaccDay
                FROM AppPolioDbBundle:AdminData adm JOIN adm.campaign c JOIN adm.districtCode d JOIN d.provinceCode p WHERE c.campaignId in (:camp) AND d.districtCode IN (:dist) ORDER BY p.provinceRegion, p.provinceName, d.districtName, adm.cluster, adm.vaccDay "
          )-> setParameters(['camp'=>$campaign, 'dist' => $district])
          ->getResult(Query::HYDRATE_SCALAR);
    }

    /**
     * @param $region
     * @return array
     */
    public function selectAggRegion($region) {

      return $this->getEntityManager()
          ->createQuery(
            "SELECT adm.id as ID, p.provinceRegion as Region, p.provinceName as Province, d.districtName as District, d.districtCode as DCODE, cmp.campaignStartDate as CDate, cmp.campaignId as CID,
              cmp.campaignType as CType, cmp.campaignYear as CYear, cmp.campaignMonth as CMonth, adm.clusterName as ClusterName, adm.clusterNo as ClusterNo,
              sum(adm.receivedVials) as RVials, sum(adm.usedVials) as UVials,
              ((sum(adm.usedVials)*20 - (sum(adm.child011)+sum(adm.child1259)+sum(adm.vaccAbsent)+sum(adm.vaccSleep)+sum(adm.vaccRefusal)))/(sum(adm.usedVials)*20) * 100) as VaccWastage,
              sum(adm.child011)+SUM(adm.child1259)+sum(adm.vaccAbsent)+sum(adm.vaccSleep)+sum(adm.vaccRefusal) as VaccChild,
              sum(adm.child011) as Child011, sum(adm.child1259) as Child1259,
              sum(adm.vaccAbsent)+sum(adm.vaccSleep)+sum(adm.vaccRefusal) as MissedVaccinated,
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
              JOIN adm.districtCode d JOIN d.provinceCode p WHERE p.provinceRegion in (:regio)
              GROUP BY adm.cluster, p.provinceRegion"
        )-> setParameters(['regio'=>$region])
        ->getResult(Query::HYDRATE_SCALAR);
    }

    /**
     * @param $province
     * @return array
     */
    public function selectAggProvince($province) {

      return $this->getEntityManager()
          ->createQuery(
            "SELECT adm.id as ID, p.provinceRegion as Region, p.provinceName as Province, d.districtName as District, d.districtCode as DCODE, cmp.campaignStartDate as CDate, cmp.campaignId as CID,
              cmp.campaignType as CType, cmp.campaignYear as CYear, cmp.campaignMonth as CMonth, adm.clusterName as ClusterName, adm.clusterNo as ClusterNo,
              sum(adm.receivedVials) as RVials, sum(adm.usedVials) as UVials,
              ((sum(adm.usedVials)*20 - (sum(adm.child011)+sum(adm.child1259)+sum(adm.vaccAbsent)+sum(adm.vaccSleep)+sum(adm.vaccRefusal)))/(sum(adm.usedVials)*20) * 100) as VaccWastage,
              sum(adm.child011)+SUM(adm.child1259)+sum(adm.vaccAbsent)+sum(adm.vaccSleep)+sum(adm.vaccRefusal) as VaccChild,
              sum(adm.child011) as Child011, sum(adm.child1259) as Child1259,
              sum(adm.vaccAbsent)+sum(adm.vaccSleep)+sum(adm.vaccRefusal) as MissedVaccinated,
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
              JOIN adm.districtCode d JOIN d.provinceCode p WHERE p.provinceCode in (:prov)
              GROUP BY adm.cluster, p.provinceCode"
        )-> setParameters(['prov'=>$province])
        ->getResult(Query::HYDRATE_SCALAR);
    }

    /**
     * @param $district
     * @return array
     */
    public function selectAggDistrict($district) {

      return $this->getEntityManager()
          ->createQuery(
            "SELECT adm.id as ID, p.provinceRegion as Region, p.provinceName as Province, d.districtName as District, d.districtCode as DCODE, cmp.campaignStartDate as CDate, cmp.campaignId as CID,
              cmp.campaignType as CType, cmp.campaignYear as CYear, cmp.campaignMonth as CMonth, adm.clusterName as ClusterName, adm.clusterNo as ClusterNo,
              sum(adm.receivedVials) as RVials, sum(adm.usedVials) as UVials,
              ((sum(adm.usedVials)*20 - (sum(adm.child011)+sum(adm.child1259)+sum(adm.vaccAbsent)+sum(adm.vaccSleep)+sum(adm.vaccRefusal)))/(sum(adm.usedVials)*20) * 100) as VaccWastage,
              sum(adm.child011)+SUM(adm.child1259)+sum(adm.vaccAbsent)+sum(adm.vaccSleep)+sum(adm.vaccRefusal) as VaccChild,
              sum(adm.child011) as Child011, sum(adm.child1259) as Child1259,
              sum(adm.vaccAbsent)+sum(adm.vaccSleep)+sum(adm.vaccRefusal) as MissedVaccinated,
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
              JOIN adm.districtCode d JOIN d.provinceCode p WHERE d.districtCode in (:dist)
              GROUP BY adm.cluster, d.districtCode"
        )-> setParameters(['dist'=>$district])
        ->getResult(Query::HYDRATE_SCALAR);
    }

    /**
     * @param $campaign
     * @return array
     */
    public function selectAggCampaign($campaign) {

      return $this->getEntityManager()
          ->createQuery(
            "SELECT adm.id as ID, p.provinceRegion as Region, p.provinceName as Province, d.districtName as District, d.districtCode as DCODE, cmp.campaignStartDate as CDate, cmp.campaignId as CID,
              cmp.campaignType as CType, cmp.campaignYear as CYear, cmp.campaignMonth as CMonth, adm.clusterName as ClusterName, adm.clusterNo as ClusterNo,
              sum(adm.receivedVials) as RVials, sum(adm.usedVials) as UVials,
              ((sum(adm.usedVials)*20 - (sum(adm.child011)+sum(adm.child1259)+sum(adm.vaccAbsent)+sum(adm.vaccSleep)+sum(adm.vaccRefusal)))/(sum(adm.usedVials)*20) * 100) as VaccWastage,
              sum(adm.child011)+SUM(adm.child1259)+sum(adm.vaccAbsent)+sum(adm.vaccSleep)+sum(adm.vaccRefusal) as VaccChild,
              sum(adm.child011) as Child011, sum(adm.child1259) as Child1259,
              sum(adm.vaccAbsent)+sum(adm.vaccSleep)+sum(adm.vaccRefusal) as MissedVaccinated,
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
              JOIN adm.districtCode d JOIN d.provinceCode p WHERE cmp.campaignId in (:camp)
              GROUP BY adm.cluster, cmp.campaignId"
        )-> setParameters(['camp'=>$campaign])
        ->getResult(Query::HYDRATE_SCALAR);
    }

    /**
     * @param $region
     * @param $campaign
     * @return array
     */

    public function regionAggByCampaigns($region, $campaign) {

      return $this->getEntityManager()
          ->createQuery(
            "SELECT adm.id as ID, p.provinceRegion as Region, p.provinceName as Province, d.districtName as District, d.districtCode as DCODE, cmp.campaignStartDate as CDate, cmp.campaignId as CID,
              cmp.campaignType as CType, cmp.campaignYear as CYear, cmp.campaignMonth as CMonth, adm.clusterName as ClusterName, adm.clusterNo as ClusterNo,
              sum(adm.receivedVials) as RVials, sum(adm.usedVials) as UVials,
              ((sum(adm.usedVials)*20 - (sum(adm.child011)+sum(adm.child1259)+sum(adm.vaccAbsent)+sum(adm.vaccSleep)+sum(adm.vaccRefusal)))/(sum(adm.usedVials)*20) * 100) as VaccWastage,
              sum(adm.child011)+SUM(adm.child1259)+sum(adm.vaccAbsent)+sum(adm.vaccSleep)+sum(adm.vaccRefusal) as VaccChild,
              sum(adm.child011) as Child011, sum(adm.child1259) as Child1259,
              sum(adm.vaccAbsent)+sum(adm.vaccSleep)+sum(adm.vaccRefusal) as MissedVaccinated,
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
              JOIN adm.districtCode d JOIN d.provinceCode p WHERE(adm.campaign in (:camp) AND p.provinceRegion in (:region))
              GROUP BY adm.cluster, p.provinceRegion, cmp.campaignId"
        )-> setParameters(['camp'=>$campaign, 'region' => $region])
        ->getResult(Query::HYDRATE_SCALAR);
    }

    /**
     * @param $province
     * @param $campaign
     * @return array
     */
    public function provinceAggByCampaigns($province, $campaign) {

      return $this->getEntityManager()
          ->createQuery(
            "SELECT adm.id as ID, p.provinceRegion as Region, p.provinceName as Province, d.districtName as District, d.districtCode as DCODE, cmp.campaignStartDate as CDate, cmp.campaignId as CID,
              cmp.campaignType as CType, cmp.campaignYear as CYear, cmp.campaignMonth as CMonth, adm.clusterName as ClusterName, adm.clusterNo as ClusterNo,
              sum(adm.receivedVials) as RVials, sum(adm.usedVials) as UVials,
              ((sum(adm.usedVials)*20 - (sum(adm.child011)+sum(adm.child1259)+sum(adm.vaccAbsent)+sum(adm.vaccSleep)+sum(adm.vaccRefusal)))/(sum(adm.usedVials)*20) * 100) as VaccWastage,
              sum(adm.child011)+SUM(adm.child1259)+sum(adm.vaccAbsent)+sum(adm.vaccSleep)+sum(adm.vaccRefusal) as VaccChild,
              sum(adm.child011) as Child011, sum(adm.child1259) as Child1259,
              sum(adm.vaccAbsent)+sum(adm.vaccSleep)+sum(adm.vaccRefusal) as MissedVaccinated,
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
              JOIN adm.districtCode d JOIN d.provinceCode p WHERE(adm.campaign in (:camp) AND p.provinceCode in (:prov))
              GROUP BY adm.cluster, p.provinceCode, cmp.campaignId"
        )-> setParameters(['camp'=>$campaign, 'prov' => $province])
        ->getResult(Query::HYDRATE_SCALAR);
    }

    /**
     * @param $district
     * @param $campaign
     * @return array
     */
    public function districtAggByCampaigns($district, $campaign) {

      return $this->getEntityManager()
          ->createQuery(
            "SELECT adm.id as ID, p.provinceRegion as Region, p.provinceName as Province, d.districtName as District, d.districtCode as DCODE, cmp.campaignStartDate as CDate, cmp.campaignId as CID,
              cmp.campaignType as CType, cmp.campaignYear as CYear, cmp.campaignMonth as CMonth, adm.clusterName as ClusterName, adm.clusterNo as ClusterNo,
              sum(adm.receivedVials) as RVials, sum(adm.usedVials) as UVials,
              ((sum(adm.usedVials)*20 - (sum(adm.child011)+sum(adm.child1259)+sum(adm.vaccAbsent)+sum(adm.vaccSleep)+sum(adm.vaccRefusal)))/(sum(adm.usedVials)*20) * 100) as VaccWastage,
              sum(adm.child011)+SUM(adm.child1259)+sum(adm.vaccAbsent)+sum(adm.vaccSleep)+sum(adm.vaccRefusal) as VaccChild,
              sum(adm.child011) as Child011, sum(adm.child1259) as Child1259,
              sum(adm.vaccAbsent)+sum(adm.vaccSleep)+sum(adm.vaccRefusal) as MissedVaccinated,
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
              JOIN adm.districtCode d JOIN d.provinceCode p WHERE(adm.campaign in (:camp) AND d.districtCode in (:dist))
              GROUP BY adm.cluster, d.districtCode, cmp.campaignId"
        )-> setParameters(['camp'=>$campaign, 'dist' => $district])
        ->getResult(Query::HYDRATE_SCALAR);
    }

    /**
     * @param $district
     * @return array
     */
    public function selectClustereByDistrict($district) {
        return $this->getEntityManager()
            ->createQuery(
                "SELECT DISTINCT a, d.districtCode FROM AppPolioDbBundle:AdminData a JOIN a.districtCode d WHERE a.districtCode IN (:dis) Group BY a.cluster"
            ) ->setParameter('dis', $district)
            ->getResult(Query::HYDRATE_SCALAR);
    }

    /**
     * @param $cluster, $vaccday
     * @return array
     */
    public function selectCampaignsByClusterVaccDay($cluster, $vaccday) {
        return $this->getEntityManager()
            ->createQuery(
                "SELECT c.campaignId, c.campaignName FROM AppPolioDbBundle:AdminData a JOIN a.campaign c WHERE a.cluster IN (:clus) AND a.vaccDay IN (:vacc) GROUP BY c.campaignId"
            ) -> setParameters(['clus'=>$cluster, 'vacc'=>$vaccday])
              ->getResult(Query::HYDRATE_SCALAR);
    }

    /**
     * @param $campaign
     * @return array
     */
    public function checkIfCampaignExist($campaign) {
        return $this->getEntityManager()
            ->createQuery(
                "SELECT c.campaignId FROM AppPolioDbBundle:Campaign c WHERE c.campaignId IN (:camp)"
            ) ->setParameter('camp', $campaign)
            ->getResult(Query::HYDRATE_SCALAR);
    }

    /**
     * @param $districts, $campaign
     * @return array
     */
    public function checkDistrictsData($districts, $campaign) {
        return $this->getEntityManager()
            ->createQuery(
                "SELECT DISTINCT IDENTITY(adm.districtCode) FROM AppPolioDbBundle:AdminData adm WHERE (adm.districtCode IN (:dis) AND adm.campaign IN (:camp))"
            ) -> setParameters(['dis'=>$districts, 'camp'=>$campaign])
            ->getResult(Query::HYDRATE_SCALAR);
    }
}
