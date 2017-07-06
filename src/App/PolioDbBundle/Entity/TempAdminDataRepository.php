<?php

namespace App\PolioDbBundle\Entity;

use Doctrine\ORM\EntityRepository;

class TempAdminDataRepository extends EntityRepository
{
    public function adminSyncToMaster()
    {

      $sql = "
      INSERT INTO admin_data(district_code, sub_district_name, cluster_name, cluster_no, cluster, target_population, used_vials,
      child_0_11, child_12_59, reg_absent, vacc_absent, reg_sleep, vacc_sleep, reg_refusal,vacc_refusal, new_polio_case, vacc_day,
      campaign_id) SELECT districtCode, subDistName, clusterName, clusterNo, cluster, targetPop, usedVials, child011, child1259, regAbsent,
      vaccAbsent, regSleep, vaccSleep,regRefusal, vaccRefusal, newPolioCase, vaccDay, campaignId FROM temp_admin_data
      ";

      $em = $this->getEntityManager();
      return $em->getConnection()->query($sql);
    }

    public function truncatTempAdminData()
    {

       $sql = "TRUNCATE temp_admin_data";

      $em = $this->getEntityManager();
      return $em->getConnection()->query($sql);
    }

    
}
