<?php

namespace App\PolioDbBundle\Controller\Render;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

/**
 *
 */
class AjaxController extends Controller
{

    /**
     * @Route("/ajax/admin_data", name="ajax_admin_data")
     * @param $request
     * @return response
     */
    public function AjaxAdminDataAction(Request $request) {

        // ========================== Handling Ajax Request =================================
        $campaignIds = $request->get('campaign');
        $regions = $request->get('region');
        $provinces = $request->get('province');
        $districts = $request->get('district');
        //=========================== End of Ajax Request ===================================

        // Default Categories for the Charts (the value below should be column names in the result set
        $category = [['column'=>'Region'], ['column'=>'CID', 'substitute'=>['col1'=>'CMonth', 'col2'=>'CYear', 'short'=>'my']]];
        // Default function name, it will change based on the selected filter
        $function = 'regionAgg';

        // Second param to CallMe function
        $secondParam = null;

        // select the latest 3 campaigns if no campaign were selected
        if($campaignIds === null)
            $campaignIds = $this->get('app.settings')->lastFewCampaigns('AdminData');

        // change the regions' array of arrays to 1D array
        // check if the there are selected regions
        if($regions !== null) {
            $temp = [];
            foreach($regions as $region) {
                foreach ($region as $r)
                    $temp[] = $r;
            }

            $secondParam = $temp;
            $function = "regionAggByCampaignRegion";
        }

        // check if the filter was for selected provinces
        if($provinces !== null) {
            $secondParam = $provinces;
            $category[0] = ['column'=>'PCODE', 'substitute'=>'Province'];
            $function = 'provinceAggByCampaignProvince';
        }

        // check if the filter was for selected districts
        if($districts !== null) {

            $temp = [];
            foreach($districts as $district) {
                foreach ($district as $d)
                    $temp[] = $d;
            }

            $secondParam = $districts;
            //$secondParam = $districts;
            $category[0] = ['column'=>'DCODE', 'substitute'=>'District'];
            $function = 'districtAggByCampaignDistrict';

//            $category = [['column'=>'Province'], ['column'=>'DCODE', 'substitute'=>'District'],
//                         ['column'=>'CID', 'substitute'=>['col1'=>'CMonth', 'col2'=>'CYear', 'short'=>'my']]];

            if(array_search("VHR", $temp) > -1 || array_search('HR', $temp) > -1 || array_search('Non-V/HR districts', $temp) > -1) {
                $function = 'districtAggByCampaignDistrictRisk';
                $nonVhrIndex = array_search('Non-V/HR districts', $temp);

                $newParam['risk'] = $temp;
                $newParam['province'] = $provinces;
                if($nonVhrIndex>-1) {
                    $function = 'districtAggByCampaignDistrictRiskNull';
                }

                $secondParam = $newParam;
                //return new Response(json_encode($secondParam));
            }
        }




        //$this->get('app.settings')->trackUrl('dashboard_main');
        // this function returns latest campaign, can work for all data sources that have relation with campaign
        //$lastCamp = $this->get('app.settings')->latestCampaign('AdminData');
        // this function takes two parameters 1:table name to be joined with campaign table, 2: how many campaigns
        // to be returned (optional) by default it returns the last 3 campaigns (only ids)
        // $campaignIds = $this->get('app.settings')->lastFewCampaigns('AdminData');

        /**
         * The below method call is a dynamic function returning the data from different data-sources
         * however, you have to define a callMe() function in your Repository Class with the same structure as below
         * Then you would not need to call that function with Doctrine EntityManager, you just call chartData and pass
         * the tableName, functionName, and parameters for the original function in your repository
         */
        $regionAdminData = $this->get('app.chart')->chartData('AdminData', $function, $campaignIds, $secondParam);
        //$lastCampAdminData = $this->get('app.chart')->chartData('AdminData', 'regionAgg', [$lastCamp[0]['campaignId']]);
        // Category 1 (name must be in the result set)
        // Category 2 (name must be in the result set)
        // Array of columns to show on chart (the index is the label and the value is the column name in the result set
        // Data returned above
        $missedChildChart = $this->get('app.chart')->chartData2Categories($category[0], $category[1],
            ['RemainingRefusal'=>'Refusal',
                'RemainingNSS' => 'NSS', 'RemainingAbsent' => 'Absent'], $regionAdminData);
        $missedChildChart['title'] = "Remaining children by reasons";
        // For absent children
        $chartDataAbsent = $this->get('app.chart')->chartData2Categories($category[0], $category[1],
            ['RemainingAbsent'=>'Remaining Absent',
                'VaccAbsent' => 'Vacc Absent'], $regionAdminData);
        $chartDataAbsent['title'] = "Recovering absent children during campaign";
        // For NSS
        $chartDataNss = $this->get('app.chart')->chartData2Categories($category[0], $category[1],
            ['RemainingNSS'=>'Remaining NSS',
                'VaccNSS' => 'Vacc NSS'], $regionAdminData);
        $chartDataNss['title'] = "Recovering New born, sleep and sick children during campaign";
        // For Refusal
        $chartDataRefusal = $this->get('app.chart')->chartData2Categories($category[0], $category[1],
            ['RemainingRefusal'=>'Remaining Refusal',
                'VaccRefusal' => 'Vacc Refusal'], $regionAdminData);
        $chartDataRefusal['title'] = "Recovering refusal children during campaign";
        $lastCampVaccUsageChart = $this->get('app.chart')->chartData2Categories($category[0], $category[1],
            ['RVials'=>'ReceivedVials',
                'UVials' => 'UsedVials', 'VaccWastage' => 'Wastage'], $regionAdminData);
        $lastCampVaccUsageChart['title'] = "Vaccines usage";

        return new Response(json_encode([
            'allMissedChildren' => $missedChildChart,
            'absentChildren' => $chartDataAbsent,
            'nssChildren' => $chartDataNss,
            'refusalChildren' => $chartDataRefusal,
            'vaccineUsage' => $lastCampVaccUsageChart
        ]));

//        return new Response(json_encode([
//               'campaign'=>$campaignIds,
//               'region' => $regions,
//               'province' => $provinces,
//                'district' => $districts
//            ]
//        ));

    }

    /**
     * @Route("/ajax/admin_data_download", name="ajax_download_data")
     * @param $request
     * @return response
     */
     public function AjaxDownloadDataAction(Request $request) {

       $campaignIds = $request->get('campaign');
       $regions = $request->get('region');
       $provinces = $request->get('province');
       $districts = $request->get('district');



       if($campaignIds != null){
            $temp = [];
            $camp = [];
            foreach($campaignIds as $campaignId) {
                foreach ($campaignId as $r)
                $camp[] = $r;
            }

                if($regions != null){

                            if($provinces != null){

                                          if($districts != null){
                                              foreach($districts as $district) {
                                                foreach ($district as $r)
                                                $temp[] = $r;
                                                $function = 'districtAggByCampaigns';
                                              }
                                            }
                                          else{
                                                  foreach($provinces as $province) {
                                                      foreach ($province as $r)
                                                      $temp[] = $r;
                                                      $function = 'provinceAggByCampaigns';
                                                  }
                                          }
                                }
                            else{
                                  foreach($regions as $region) {
                                      foreach ($region as $r)
                                      $temp[] = $r;
                                      $function = 'regionAggByCampaigns';
                                  }
                            }
                }
                else{
                      foreach($campaignIds as $campaignId) {
                          foreach ($campaignId as $r)
                          $temp[] = $r;
                          $function = 'selectCampaign';
                      }

                      $em = $this->getDoctrine()->getManager();
                      $objs = $em->getRepository('AppPolioDbBundle:AdminData')
                      ->$function($temp);
                }

                $em = $this->getDoctrine()->getManager();
                $objs = $em->getRepository('AppPolioDbBundle:AdminData')
                ->$function($temp, $camp);
          }
          else{
            $temp = [];
            if($regions != null){

                        if($provinces != null){

                                      if($districts != null){
                                          foreach($districts as $district) {
                                            foreach ($district as $r)
                                            $temp[] = $r;
                                            $function = 'selectDistrict';
                                          }
                                        }
                                      else{
                                              foreach($provinces as $province) {
                                                  foreach ($province as $r)
                                                  $temp[] = $r;
                                                  $function = 'selectProvince';
                                              }
                                      }
                            }
                        else{
                              foreach($regions as $region) {
                                  foreach ($region as $r)
                                  $temp[] = $r;
                                  $function = 'selectRegion';
                              }
                        }
              }
              $em = $this->getDoctrine()->getManager();
              $objs = $em->getRepository('AppPolioDbBundle:AdminData')
              ->$function($temp);
            }

      //  if($regions !== null) {
      //    $temp = [];
      //    foreach($regions as $region) {
      //      foreach ($region as $r)
      //      $temp[] = $r;
      //    }
      //  }

      //  $em = $this->getDoctrine()->getManager();
      //  $objs = $em->getRepository('AppPolioDbBundle:AdminData')
      //  ->$function($temp);
       return new Response(json_encode($objs));

     }

     /**
      * @Route("/ajax/admin_data_all", name="ajax_download_data_all")
      * @param $request
      * @return response
      */
      public function AjaxDownloadDataAllAction(Request $request) {


        $em = $this->getDoctrine()->getManager();
        $objs = $em->getRepository('AppPolioDbBundle:AdminData')
        ->selectAllAdminData();

          return new Response(json_encode($objs));
      }

}
