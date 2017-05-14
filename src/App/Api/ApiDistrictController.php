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
class ApiDistrictController extends Controller
{

    /**
     * @Route("api/get/admin_data/district/{district}", name="api_get_admin_data_district")
     * @return Response
     * @param $district
     */
    public function getAdminDataDistrictAction($district) {
        $months = $this->get('app.settings')->monthsYear(3);
        $em = $this->getDoctrine()->getManager();
        $data = $em->getRepository('AppPolioDbBundle:ClusterAgg')
            ->selectClusterDataByDistrictMonths($district, $months);
        $data = $this->get('app.chart')->makeClusterData($data);
        return new Response(json_encode($data));
    }


}
