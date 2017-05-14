<?php

namespace App\PolioDbBundle\Controller\Render;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DistrictController extends Controller
{
    /**
     * @return Response
     * @Route("/admin_data/district/{district}/{camp}", defaults={"camp"="0"}, name="admin_data_district")
     * @param $district
     * @param $camp
     */
    public function indexAction($district, $camp) {
        $em = $this->getDoctrine()->getManager();
        $data_district = $em->getRepository('AppPolioDbBundle:District')
            ->findOneByDistrictCode($district);
        if(!is_array($data_district) && count($data_district) <= 0)
            throw $this->createNotFoundException('Bad request!');
        $data = $em -> getRepository('AppPolioDbBundle:DistrictData')
            ->selectDistrictsByProvince($data_district->getProvinceCode());
        $bak_url = $em->getRepository('AppPolioDbBundle:Province')
            ->findOneByProvinceCode($data_district->getProvinceCode());
        $token = $bak_url->getProvinceCode();

        //$cam = array();
        $cam = json_decode($camp);
        $campaigns = $this->get('app.settings')->campaignMenu("AdminData");

        if($camp === '0')
        {
            $cam = array();
            $i = 0;
            foreach ($campaigns as $campaign)
            {
                if($i == 3)
                    break;
                $cam[] = $campaign['campaignId'];
                $i ++;
            }
        }
        $clusters = $em->getRepository('AppPolioDbBundle:ClusterAgg')
            ->selectClusterDataByDistrictCampaign($district, $cam);
        $clusters = $this->get('app.chart')->makeClusterData($clusters);

        //die(json_encode($clusters));

        return $this->render("pages/admin_data_district.html.twig",
            ['ajax_url_var'=>$district, 'back_url' => "$token", 'district' => $data,
             'clusters' => $clusters, 'campaigns' => $campaigns, 'selected'=>$cam]);
    }

    /**
     * @return Response
     * @Route("/admin_data/district/", name="admin_data_district_filter")
     * @param $request
     */

    public function customAction(Request $request) {

        //die(var_dump($request->request->all()));
        $data = $request->request->all();
        $cam = $data['s2'];
        $dist = $data['district_id'];

        return $this->redirectToRoute('admin_data_district', array('district'=>$dist, 'camp'=>json_encode($cam)));
//        $em = $this->getDoctrine()->getManager();
//        $data_district = $em->getRepository('AppPolioDbBundle:District')
//            ->findOneByDistrictCode($district);
//        if(!is_array($data_district) && count($data_district) <= 0)
//            throw $this->createNotFoundException('Bad request!');
//        $data = $em -> getRepository('AppPolioDbBundle:DistrictData')
//            ->selectDistrictsByProvince($data_district->getProvinceCode());
//        $bak_url = $em->getRepository('AppPolioDbBundle:Province')
//            ->findOneByProvinceCode($data_district->getProvinceCode());
//        $token = $bak_url->getProvinceCode();
//
//        $campaigns = $this->get('app.settings')->campaignMenu();
//        $cam = array();
//        $i = 0;
//        foreach ($campaigns as $campaign)
//        {
//            if($i == 3)
//                break;
//            $cam[] = $campaign['campaignId'];
//            $i ++;
//        }
//        $clusters = $em->getRepository('AppPolioDbBundle:ClusterAgg')
//            ->selectClusterDataByDistrictCampaign($district, $cam);
//        $clusters = $this->get('app.chart')->makeClusterData($clusters);
//
//        return $this->render("pages/admin_data_district.html.twig",
//            ['ajax_url_var'=>$district, 'back_url' => "$token", 'district' => $data,
//                'clusters' => $clusters, 'campaigns' => $campaigns, 'selected'=>$cam]);
    }

}
