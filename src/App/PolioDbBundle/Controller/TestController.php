<?php
/**
 * Created by PhpStorm.
 * User: wakhan
 * Date: 12/8/2016
 * Time: 7:27 PM
 */

namespace App\PolioDbBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TestController extends Controller
{
    /**
     * @Route("test/my_test/")
     *
     */
    public function myTestAction() {
        $curr_y = date('Y');
        $curr_m = date('F');

        $em = $this->getDoctrine()->getManager();
        $data = $this->get('app.settings')->campaignMenu();
//        $data = $em->getRepository('AppPolioDbBundle:RegionAgg')
//            ->selectAllRegionAggByWhere($data);
//
//
//        $data = $this->get('app.chart')->makeDataRegion($data);

        return new Response("<html><body>".json_encode($data)." </body></html>");
    }

}