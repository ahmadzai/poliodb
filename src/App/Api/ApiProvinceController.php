<?php

namespace App\PolioDbBundle\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 *
 */
class ApiProvinceController extends Controller
{

    /**
     * @Route("api/get/admin_data/province/{slug}", defaults={"slug"="all"}, name="api_get_admin_data_province")
     * @return Response
     * @param $slug
     */
  public function getAdminDataProvinceAction($slug) {
      $em = $this->getDoctrine()->getManager();
      $prov = $em->getRepository('AppPolioDbBundle:Province')
          ->findOneByProvinceCode($slug);

      $channel = "";
      if(is_numeric($slug) && $slug < 35) {
          $campaigns = $this->get('app.settings')->campaignMenu("AdminData");
          $cam = array();
          $i = 0;
          foreach ($campaigns as $campaign)
          {
              if($i == 3)
                  break;
              $cam[] = $campaign['campaignId'];
              $i ++;
          }
          $data = $em->getRepository('AppPolioDbBundle:DistrictAgg')
              ->selectDistrictAggByProvinceCampaign($slug, $cam);
          $channel = $this->get('app.chart')->stackChart($data, 'district');
          $channel['title'] = $prov->getProvinceName()." Remaining Children";
      }
      return new Response(json_encode($channel));
  }


}
