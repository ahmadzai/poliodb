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
class ApiRegionController extends Controller
{
    /**
     * @Route("api/get/admin_data/region/{slug}", name="api_get_admin_data_region")
     * @return Response
     * @param $slug
     */
    public function apiGetAdminDataRegionAction($slug) {
        $em = $this->getDoctrine()->getManager();
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
        $data = $em->getRepository('AppPolioDbBundle:ProvinceAgg')
            ->selectProvinceAggByRegionCampaign($slug, $cam);
        $channel = $this->get('app.chart')->stackChart($data, 'province');
        $channel['title'] = strtoupper($slug)." Provinces Remaining Children";
        return new Response(json_encode($channel));
    }

}
