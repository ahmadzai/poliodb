<?php

namespace App\PolioDbBundle\Controller\Render;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use App\PolioDbBundle\Entity\TempAdminData;
use App\PolioDbBundle\Entity\Province;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class DashboardController extends Controller
{
    /**
     * @Route("/", name="dashboard_main")
     */
    public function DashboardMainAction() {

        $this->get('app.settings')->trackUrl('dashboard_main');
        // this function returns latest campaign, can work for all data sources that have relation with campaign
        $lastCamp = $this->get('app.settings')->latestCampaign('AdminData');
        // this function takes two parameters 1:table name to be joined with campaign table, 2: how many campaigns
        // to be returned (optional) by default it returns the last 3 campaigns (only ids)
        $campaignIds = $this->get('app.settings')->lastFewCampaigns('AdminData');

        $category = [['column'=>'Region'], ['column'=>'CID', 'substitute'=>['col1'=>'CMonth', 'col2'=>'CYear', 'short'=>'my']]];

        /**
         * The below method call is a dynamic function returning the data from different data-sources
         * however, you have to define a callMe() function in your Repository Class with the same structure as below
         * Then you would not need to call that function with Doctrine EntityManager, you just call chartData and pass
         * the tableName, functionName, and parameters for the original function in your repository
         */
        $regionAdminData = $this->get('app.chart')->chartData('AdminData', 'regionAgg', $campaignIds);
        $lastCampAdminData = $this->get('app.chart')->chartData('AdminData', 'campaignStatistics', $lastCamp[0]['campaignId']);
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
        return $this->render("html/home.html.twig",
            ['chart1data' => json_encode($missedChildChart),
                'chartDataAbsent' => json_encode($chartDataAbsent),
                'chartDataNss' => json_encode($chartDataNss),
                'chartDataRefusal' => json_encode($chartDataRefusal),
                'chartVaccineUsage' => json_encode($lastCampVaccUsageChart),
                'lastCampData' => $lastCampAdminData]);

    }

    /**
     * @Route("/dashboard/admin_data", name="dashboard_admin_data")
     */
    public function DashboardAdminDataAction()
    {
        $this->get('app.settings')->trackUrl('dashboard_admin_data');
        // this function returns latest campaign, can work for all data sources that have relation with campaign
        $lastCamp = $this->get('app.settings')->latestCampaign('AdminData');
        // this function takes two parameters 1:table name to be joined with campaign table, 2: how many campaigns
        // to be returned (optional) by default it returns the last 3 campaigns (only ids)
        $campaignIds = $this->get('app.settings')->lastFewCampaigns('AdminData');

        $category = [['column'=>'Region'], ['column'=>'CID', 'substitute'=>['col1'=>'CMonth', 'col2'=>'CYear', 'short'=>'my']]];

        /**
         * The below method call is a dynamic function returning the data from different data-sources
         * however, you have to define a callMe() function in your Repository Class with the same structure as below
         * Then you would not need to call that function with Doctrine EntityManager, you just call chartData and pass
         * the tableName, functionName, and parameters for the original function in your repository
         */
        $regionAdminData = $this->get('app.chart')->chartData('AdminData', 'regionAgg', $campaignIds);
        $lastCampAdminData = $this->get('app.chart')->chartData('AdminData', 'campaignStatistics', $lastCamp[0]['campaignId']);
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
        return $this->render("dashboard/admin_data_dashboard.html.twig",
            ['chart1data' => json_encode($missedChildChart),
                'chartDataAbsent' => json_encode($chartDataAbsent),
                'chartDataNss' => json_encode($chartDataNss),
                'chartDataRefusal' => json_encode($chartDataRefusal),
                'chartVaccineUsage' => json_encode($lastCampVaccUsageChart),
                'lastCampData' => $lastCampAdminData,
                'url'=>'dashboard_admin_data']);
    }

    /**
     * @Route("/dashboard/icm_data", name="dashboard_icm_data")
     */
    public function DashboardIcmDataAction()
    {
        return $this->render("pages/home.html.twig");
    }

    /**
     * @Route("/dashboard/catchup_data", name="dashboard_catchup_data")
     */
    public function DashboardCatchupDataAction()
    {
        return $this->render("pages/home.html.twig");
    }


}
