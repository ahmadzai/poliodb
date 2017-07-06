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
class CommonChartController extends Controller
{

    /**
     * @Route("/sparkline_chart", name="sparkline_chart")
     * @Method("GET")selectProvinceByRegion
     */
    public function sparkLineChartAction()
    {

        // this function returns latest campaign, can work for all data sources that have relation with campaign
        $lastCamp = $this->get('app.settings')->latestCampaign('AdminData');
        $lastCampAdminData = $this->get('app.chart')->chartData('AdminData', 'campaignStatistics', $lastCamp[0]['campaignId']);

        return $this->render("html/common/sparkline-charts.html.twig", ['lastCampData' => $lastCampAdminData]);
    }



}
