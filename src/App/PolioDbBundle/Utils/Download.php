<?php
namespace App\PolioDbBundle\Utils;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query;
use Symfony\Component\HttpFoundation\Session\Session;

class Download
{

      protected $em;

      public function __construct(EntityManager $entityManager)
      {
          $this->em = $entityManager;

      }

      public function latestCampaignForAdmin($camp) {

              $data = $this->em->createQuery(
                "SELECT adm.id as ID, p.provinceRegion as Region, p.provinceName as Province, d.districtName as District, adm.subDistrictName as SDistrict, adm.cluster as Cluster,
                c.campaignType as CType, c.campaignMonth as CMonth, c.campaignYear as CYear, adm.receivedVials as ReceivedVials
                , adm.usedVials as UsedVials,
                adm.child011 as Child011, adm.child1259 as Child1259, adm.regAbsent as RegAbsent, adm.vaccAbsent as VaccAbsent, adm.missed as RemainingAbsent,
                adm.regSleep as RegSleep
                , adm.vaccSleep as VaccSleep, adm.sleep as RemainingSleep, adm.regRefusal as RegRefusal, adm.vaccRefusal as VaccRefusal, adm.refusal as RemainingRefusal, adm.vaccDay as VaccDay
                    FROM AppPolioDbBundle:AdminData adm JOIN adm.campaign c JOIN adm.districtCode d JOIN d.provinceCode p WHERE c.campaignId in (:camp)"
                ) -> setParameters(['camp'=>$camp])
                  ->getResult(Query::HYDRATE_SCALAR);
              return $data;
      }

      public function lastThreeAdminRows() {

              $data = $this->em->createQuery(
                "SELECT adm.subDistrictName as SDistrict, adm.cluster as Cluster, adm.targetPopulation as TargetPopulation,
                adm.receivedVials as ReceivedVials, adm.usedVials as UsedVials,
                adm.child011 as Child011, adm.child1259 as Child1259, adm.regAbsent as RegAbsent, adm.vaccAbsent as VaccAbsent,
                adm.regSleep as RegSleep, adm.vaccSleep as VaccSleep, adm.regRefusal as RegRefusal, adm.vaccRefusal as VaccRefusal,
                adm.newPolioCase as NPolioCase, adm.vaccDay as VaccDay, (adm.districtCode) as District, (adm.campaign) as CampaignID
                    FROM AppPolioDbBundle:AdminData adm ORDER BY adm.id DESC"
                ) ->setMaxResults(3)
                  ->getResult(Query::HYDRATE_SCALAR);
              return $data;
      }

      public function latestCampaignForCatchup($camp) {

              $data = $this->em->createQuery(
                "SELECT p.provinceRegion as Region, p.provinceName as Province, d.districtName as District, cat.subDistrictName as SDistrict, cat.clusterNo as ClusterNo,
                c.campaignType as CType, c.campaignMonth as CMonth, c.campaignYear as CYear, cat.regAbsent as RegAbsent, cat.vaccAbsent as VaccAbsent,
                cat.regSleep as RegSleep, cat.vaccSleep as VaccSleep, cat.regRefusal as RegRefusal, cat.vaccRefusal as VaccRefusal, cat.newMissed as NewMissed,
                cat.newVaccinated as NewVaccinated, cat.newRemaining as NewRemaining
                    FROM AppPolioDbBundle:CatchupData cat JOIN cat.campaign c JOIN cat.districtCode d JOIN d.provinceCode p WHERE c.campaignId in (:camp)"
                ) -> setParameters(['camp'=>$camp])
                  ->getResult(Query::HYDRATE_SCALAR);
              return $data;
      }

      public function latestCampaignForIcm($camp) {

              $data = $this->em->createQuery(
                "SELECT p.provinceRegion as Region, p.provinceName as Province, d.districtName as District, icm.noTeamMonitored as NoTeamMonitored, icm.vaccinatorTrained as VaccinatorTrained,
                c.campaignType as CType, c.campaignMonth as CMonth, c.campaignYear as CYear, icm.vaccStage3 as VaccStage3, icm.teamSupervised as TeamSupervised,
                icm.teamWithChw as TeamWithChw, icm.teamWithFemale as TeamWithFemale, icm.teamAccomSm as TeamAccomSm, icm.noMissedChildNovisit as NoMissedChildNovisit, icm.noChildSeen as NoChildSeen,
                icm.noChildWithFm as NoChildWithFm, icm.noMissedChild as NoMissedChild, icm.noMissed10 as NoMissed10
                    FROM AppPolioDbBundle:IcmData icm JOIN icm.campaign c JOIN icm.districtCode d JOIN d.provinceCode p WHERE c.campaignId in (:camp)"
                ) -> setParameters(['camp'=>$camp])
                  ->getResult(Query::HYDRATE_SCALAR);
              return $data;
      }
}
