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
use Symfony\Component\HttpFoundation\Session\Session;

class Settings
{
    //const VISITED_URL = 'dashboard_main';

    protected $em;

    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;

    }

    public function trackUrl($url = 'dashboard_main') {
        $session = new Session();
        $session->set('visited_url', $url);
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
    public function latestCampaign($table, $campaignId = 0) {

        if($campaignId === 0 || $campaignId == 0) {
            $data = $this->em->createQuery(
                "SELECT ca.campaignId, ca.campaignMonth, ca.campaignType, ca.campaignYear
               FROM AppPolioDbBundle:$table a
               JOIN a.campaign ca ORDER BY ca.campaignId DESC"
              ) ->setFirstResult(1)
                ->setMaxResults(1)
                ->getResult(Query::HYDRATE_SCALAR);
            //$campaignId = $data[0]['CampID'];
            return $data;
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

    /**
     * @param $table
     * @param int $no default 3 campaigns
     * @return array
     */
    public function lastFewCampaigns($table, $no = 3) {
        $campaigns = $this->campaignMenu($table);
        $cam = [];
        $i = 0;
        foreach ($campaigns as $campaign) {
            if($i == $no)
                break;
            $cam[] = $campaign['campaignId'];
            $i++;
        }

        return $cam;
    }

//    public function dashboardMenu() {
//        $menu = $this->em->getRepository('AppPolioDbBundle:TablesManager')->findAll();
//        return $menu;
//    }


}
