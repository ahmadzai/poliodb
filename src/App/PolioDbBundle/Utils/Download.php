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
                "SELECT p.provinceRegion as Region, p.provinceName as Province, d.districtName as District, adm.subDistrictName as SDistrict, adm.cluster as Cluster,
                c.campaignType as CType, c.campaignMonth as CMonth, c.campaignYear as CYear, adm.receivedVials as ReceivedVials
                , adm.usedVials as UsedVials, adm.child011 as Child011, adm.child1259 as Child1259, adm.regAbsent as RegAbsent, adm.vaccAbsent as VaccAbsent, adm.regSleep as RegSleep
                , adm.vaccSleep as VaccSleep, adm.regRefusal as RegRefusal, adm.vaccRefusal as VaccRefusal, adm.vaccDay as VaccDay, adm.missed as Missed
                    FROM AppPolioDbBundle:AdminData adm JOIN adm.campaign c JOIN adm.districtCode d JOIN d.provinceCode p WHERE c.campaignId in (:camp)"
                ) -> setParameters(['camp'=>$camp])
                  ->getResult(Query::HYDRATE_SCALAR);
              return $data;
      }
}
