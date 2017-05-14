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

}