<?php
namespace App\PolioDbBundle\Utils;
/**
 * Created by PhpStorm.
 * User: wakhan
 * Date: 11/12/2016
 * Time: 6:44 PM
 */
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query;
class Settings
{

    protected $em;

    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;

    }

    /***
     * @param $months array of months
     * @return order_months
     */
    function orderMonths($months) {
        $order_months = array();
        if(is_array($months) && count($months) > 0) {
            $temp = array();
            foreach($months as $month) {
                $m = date_parse($month);
                $temp[$m['month']] = $month;
            }
            ksort($temp);
            $order_months = $temp;
        }

        return $order_months;
    }

    function testMethod() {
        echo "hello this is done";
    }

    /**
     * @param $table
     * @return array
     */
    public function campaignMenu($table)
    {

        $data = $this->em->createQuery(
            "SELECT ca.campaignId, ca.campaignMonth, ca.campaignType, ca.campaignYear
             FROM AppPolioDbBundle:$table a
             JOIN a.campaign ca GROUP BY ca.campaignId ORDER BY ca.campaignId DESC"
        )
            ->getResult(Query::HYDRATE_SCALAR);
//        $months_years = array();
//        $where = "";
//        if (count($data) > 0 && count($data) >= $count)
//            for ($i = 0; $i < $count; $i++) {
//                $months_years[$data[$i]['cMonth']] = $data[$i]['cYear'];
//                $where .= "(d.cYear = " . $data[$i]['cYear'] . " and d.cMonth = '" . $data[$i]['cMonth'] . "') ";
//                if ($i < $count - 1)
//                    $where .= "OR ";

        return $data;

    }

    /**
     * @param $table
     * @param $campaignId
     * @return single campaign
     */
    public function campaignLatest($table, $campaignId = 0) {

        if($campaignId === 0 || $campaignId == 0) {
            $data = $this->em->createQuery(
                "SELECT distinct MAX (ca.campaignId) as CampID
             FROM AppPolioDbBundle:$table a
             JOIN a.campaign ca GROUP BY ca.campaignId ORDER BY ca.campaignId DESC"
            )->getResult(Query::HYDRATE_SCALAR);
            $campaignId = $data[0]['CampID'];
            return $campaignId;
        }
        else {
          $data = $this->em->createQuery(
              "SELECT ca.campaignId, ca.campaignMonth, ca.campaignType, ca.campaignYear
               FROM AppPolioDbBundle:$table a
               JOIN a.campaign ca WHERE ca.campaignId =:camp"
          )->setParameter('camp', $campaignId)->getResult(Query::HYDRATE_SCALAR);
          return $data;
       }
    }


}
