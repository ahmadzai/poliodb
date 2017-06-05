<?php

namespace App\PolioDbBundle\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
//use Symfony\Component\BrowserKit\Request;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

/**
 *
 */
class ApiMainController extends Controller
{

    /**
     * @Route("api/get/admin_data/all/{indicator}", name="api_get_admin_data_by_indicator")
     * @param $indicator
     * @return Response
     */
    public function apiGetAdminDataAction($indicator) {
        $em = $this->getDoctrine()->getManager();
        $campaigns = $this->get('app.settings')->campaignMenu('AdminData');
        $cam = array();
        $i = 0;
        foreach ($campaigns as $campaign)
        {
            if($i == 3)
                break;
            $cam[] = $campaign['campaignId'];
            $i ++;
        }

        $data = $em->getRepository('AppPolioDbBundle:RegionAgg')
            ->selectAllRegionAggByCampaign($cam);

        // indicator must be one of these: remaining, vaccinated, vaccines
        $parms = array();
        $parms['cat1'] = 'd_region';
        $parms['cat2'] = 'd_cMonth';
        if($indicator == "remaining") {

            $parms['indicators'] = ['Refusal'=>'d_remainingRefusal',
                        'Sleep' => 'd_remainingSleep',
                        'Absent'=>'d_remainingAbsent'];
            $parms['title'] = "Remaining Children By Region";

        } elseif($indicator == "vaccinated") {

            $parms['indicators'] = ['Child_0_11_Months'=>'d_child0To11',
                        'Child_12_59_Months' => 'd_child12To59'];
            $parms['title'] = "Vaccinated Children By Region";

        } elseif($indicator == "vaccines") {

            $data = $em->getRepository('AppPolioDbBundle:RegionAgg')
                ->selectAllRegionVaccUsageByCampaign($cam);

            $parms['indicators'] = ['Received Vials'=>'d_receivedVials',
                        'Used Vials' => 'd_usedVials',
                        'Vaccine Wastage' => 'wastage'];
            $parms['title'] = "Vaccine Usage By Region";

        }

        $channel = $this->get('app.chart')->chartData2Categories($parms['cat1'], $parms['cat2'], $parms['indicators'], $data);
        $channel['title'] = $parms['title'];
        $parms = null;
        $data = null;
        return new Response(json_encode($channel));
    }

    /**
     * @Route("api/get/admin_data/all/{campaign}/{indicator}", name="api_get_admin_data_by_campaign_indicator",
     *     defaults={"campaign":0}, requirements={"campaign":"\d+"})
     * @return Response
     * @param $campaign
     * @param $indicator
     */
    public function apiGetAdminDataByCampaignAction($campaign, $indicator) {
        $campData = $this->get('app.settings')->campaignLatest('AdminData', $campaign);

        if ($campaign == 0) {
            $campaign = $campData;

            $campData = $this->get('app.settings')->campaignLatest('AdminData', $campaign);

        }

        $em = $this->getDoctrine()->getManager();
        $data = $em->getRepository('AppPolioDbBundle:RegionAgg')
            ->selectAllRegionAggByCampaign($campaign);

        $parms = array();
        $parms['cat1'] = 'd_region';
        if($indicator == "remaining") {
            $parms['indicators'] = ['Refusal'=>'d_remainingRefusal',
                'Sleep' => 'd_remainingSleep',
                'Absent'=>'d_remainingAbsent'];
            $parms['title'] = "Remaining Children By Region";

        } elseif($indicator == "vaccinated") {

            $parms['indicators'] = ['Child_0_11_Months'=>'d_child0To11',
                'Child_12_59_Months' => 'd_child12To59'];
            $parms['title'] = "Vaccinated Children By Region";

        } elseif($indicator == "vaccines") {

            $data = $em->getRepository('AppPolioDbBundle:RegionAgg')
                ->selectAllRegionVaccUsageByCampaign($campaign);

            $parms['indicators'] = ['Received Vials'=>'d_receivedVials',
                'Used Vials' => 'd_usedVials',
                'Vaccine Wastage' => 'wastage'];
            $parms['title'] = "Vaccine Usage By Region";

        }

        $data = $this->get('app.chart')->chartData1Category($parms['cat1'], $parms['indicators'], $data);
        $campName = $campData[0]['campaignMonth'].'-'.$campData[0]['campaignType'].'-'.$campData[0]['campaignYear'];
        $data['title'] = $parms['title']." ".$campName;
        $parms = null;

        //return new Response(json_encode($campData));
        return new Response(json_encode($data));
    }

    /**
     * @Route("api/get/admin_data/all/last_vaccinated", name="api_get_admin_data_last_vaccinated")
     * @return Response
     */
    public function apiGetAdminDataLastCampaignVaccinatedAction() {
        $em = $this->getDoctrine()->getManager();
        $data = $em->getRepository('AppPolioDbBundle:RegionAgg')
            ->selectAllRegionVaccUsageByCampaign([10]);
        $data = $this->get('app.chart')->chartData1Category('d_region',
            ['Child_0_11_Months'=>'d_child0To11',
                'Child_12_59_Months' => 'd_child12To59'], $data);
        $data['title'] = "Last Campaign's Vaccinated Children By Region";

        return new Response(json_encode($data));
    }

    /**
     * @Route("api/get/admin_data/all/single/", name="api_get_admin_data_by_object")
     * @return Response
     * @param $request
     */
    public function apiGetAdminDataByObjectAction(Request $request) {

        $content = $request->getContent();
        $requestData = json_decode($content);
        //return new Response(var_dump($data));

        $em = $this->getDoctrine()->getManager();
        $data = $em->getRepository('AppPolioDbBundle:RegionAgg')
            ->selectAllRegionAggByCampaign($requestData->campaignId);
        $data = $this->get('app.chart')->pieData1Category($requestData->cat,
            $requestData->indicator, $requestData->substitute, $data);

        $campData = $this->get('app.settings')->campaignLatest('AdminData', $requestData->campaignId);
        $campName = $campData[0]['campaignMonth'].'-'.$campData[0]['campaignType'].'-'.$campData[0]['campaignYear'];
        $data['title'] = "Refusal By Region ".$campName;

        return new Response(json_encode($data));

    }

    /**
     * @Route("api/get/admin_data/all/{indicator}/{campaign}", name="api_get_admin_data_by_indicator_campaign",
     *     requirements={"campaign":"\d+"})
     * @return Response
     */
    public function apiGetAdminDataByCampIndicatorAction($indicator, $campaign) {
        $em = $this->getDoctrine()->getManager();
        $data = $em->getRepository('AppPolioDbBundle:RegionAgg')
            ->selectAllRegionVaccUsageByCampaign([13]);
        $data = $this->get('app.chart')->chartData1Category('d_region',
            ['Received Vials'=>'d_receivedVials',
                'Used Vials' => 'd_usedVials',
                'Vaccine Wastage' => 'wastage'], $data);
        $data['title'] = "Last Campaign's Vaccine Usage By Region";

        return new Response(json_encode($data));
    }


}
