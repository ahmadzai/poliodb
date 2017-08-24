<?php

namespace App\PolioDbBundle\Controller;

use App\PolioDbBundle\Entity\Campaign;
use App\PolioDbBundle\Entity\Province;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 *
 */
class FilterController extends Controller
{

    /**
     * @Route("/smallFilter", name="small_filter")
     * @Method("GET")selectProvinceByRegion
     */
    public function smallFilterAction()
    {


        $em = $this->getDoctrine()->getManager();

        $selectedCampaigns = $this->get('app.settings')->lastFewCampaigns('AdminData');

        $campaigns = $em->getRepository('AppPolioDbBundle:Campaign')->findBy([], ['campaignId' => 'DESC']);

        $regions = $em->getRepository('AppPolioDbBundle:Province')->selectAllRegions();

        return $this->render("html/common/filter-small.html.twig", ['campaigns' => $campaigns, 'regions' => $regions, 'selectedCampaign' => $selectedCampaigns]);
    }

    /**
     * @Route("filter/province", name="filter_province")
     * @param Request $request
     * @return Response
     */
    public function filterProvinceAction(Request $request) {

        $region = $request->get('region');
        //$requestData = json_decode($content);


        //return new Response(var_dump($content));

        $em = $this->getDoctrine()->getManager();
        $data = $em->getRepository('AppPolioDbBundle:Province')
            ->selectProvinceByRegion($region);

        $response = array();

        foreach ($region as $reg) {
            $temp = array();
            foreach ($data as $option) {
                if($option['p_provinceRegion'] == $reg[0]) {
                    $temp[] = array('label' => $option['p_provinceName'], 'value' => $option['p_provinceCode']);
                    //$response .= "<option value='".$option['p_provinceCode']."'>".$option['p_provinceName']."</option>";
                }
            }

            $response[] = array('label'=>$reg[0], 'children'=>$temp);
        }



        return new Response(
            json_encode($response)
        );

    }

    /**
     * @Route("filter/district", name="filter_district")
     * @param Request $request
     * @return Response
     */
    public function filterDistrictAction(Request $request) {

        $province = $request->get('province');
        //$requestData = json_decode($content);


        //return new Response(var_dump($content));

        $em = $this->getDoctrine()->getManager();
        $data = $em->getRepository('AppPolioDbBundle:District')
            ->selectDistrictByProvince($province);

        $response = array();
        $flag_vhr = false;
        $flag_hr = false;
        foreach ($province as $prov) {
            $temp = array();
            $pname = '';
            foreach ($data as $option) {
                if($option['d_districtRiskStatus'] == "VHR")
                    $flag_vhr = true;
                if($option['d_districtRiskStatus'] == "HR")
                    $flag_hr = true;
                if($option['provinceCode'] == $prov[0]) {
                    $pname = $option['provinceName'];
                    $temp[] = array('label' => $option['d_districtName'], 'value'=>$option['d_districtCode']);
                    //$response .= "<option value='".$option['p_provinceCode']."'>".$option['p_provinceName']."</option>";
                }
            }

            $response[] = array('label'=>$pname, 'children'=>$temp);
        }

        $newResponse = array();
        $moreOptions = array();
        if($flag_vhr)
            $moreOptions[] = array('label'=>'VHR districts', 'value'=>'VHR');
        if($flag_hr) {
            $moreOptions[] = array('label' => 'HR districts', 'value' => 'HR');
        }
        if(count($response)>0 && ($flag_hr || $flag_vhr)) {
            $moreOptions[] = array('label' => 'Non-V/HR districts', 'value' => null);

            $newResponse = array_merge($moreOptions, $response);
        }


        return new Response(
            json_encode((count($newResponse)>count($response)?$newResponse:$response))
        );

    }

    /**
     * @Route("/dataentryFilter", name="dataentry_filter")
     * @Method("GET")selectProvinceByRegion
     */
    public function dataentryFilterAction()
    {


        $em = $this->getDoctrine()->getManager();

        $noEntryCampaigns = $this->get('app.settings')->noEntryCampaigns('AdminData');

        $selectedCampaigns = $this->get('app.settings')->lastFewCampaigns('AdminData');

        $campaigns = $em->getRepository('AppPolioDbBundle:Campaign')->findBy([], ['campaignId' => 'DESC']);

        $regions = $em->getRepository('AppPolioDbBundle:Province')->selectAllRegions();

        return $this->render("html/common/dataentry-small.html.twig", ['campaigns' => $campaigns, 'regions' => $regions, 'selectedCampaign' => $selectedCampaigns, 'noentrycamps' => $noEntryCampaigns]);
    }

    /**
     * @Route("filter/cluster", name="filter_cluster")
     * @param Request $request
     * @return Response
     */
    public function filterClusterAction(Request $request) {

        $district = $request->get('district');
        //$requestData = json_decode($content);


        //return new Response(var_dump($content));

        $em = $this->getDoctrine()->getManager();
        $data = $em->getRepository('AppPolioDbBundle:AdminData')
            ->selectClustereByDistrict($district);

        $response = array();

        foreach ($district as $dis) {
            $temp = array();
            foreach ($data as $option) {
                if($option['districtCode'] == $dis[0]) {
                    $temp[] = array('label' => $option['a_cluster'], 'value' => $option['a_cluster']);
                    //$response .= "<option value='".$option['p_provinceCode']."'>".$option['p_provinceName']."</option>";
                }
            }

            $response[] = array('label'=>'Clusters', 'children'=>$temp);
        }



        return new Response(
            json_encode($response)
        );

    }

}
