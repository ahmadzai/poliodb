<?php

namespace App\PolioDbBundle\Controller\Render;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class MainController extends Controller
{
    /**
     * @Route("/odk", name="home_odk")
     */
    public function indexAction()
    {
        return $this->render("pages/home.html.twig");
    }

    /**
     * @return Response
     * @Route("/", name="home_admin_data")
     */
    public function homeAdminDataAction()
    {
        $em = $this->getDoctrine()->getManager();
        $data = $em->getRepository('AppPolioDbBundle:ProvinceData')
            ->selectAllRegions();
        return $this->render("pages/admin_data.html.twig", ['ajax_url_var'=>'all', 'region' => $data]);
    }

    /**
     * @return Response
     * @Route("/testquery", name="test")
     */
    public function testQuery()
    {
        $em = $this->getDoctrine()->getManager();
        $data = $em->getRepository('AppPolioDbBundle:AdminData')
            //->adminDataAllByDay(1);
            ->clusterAgg([9, 10], 3301);
        return new Response(json_encode($data));
    }

    /**
     * @Route("/upload", name="upload")
     */
    public function uploadAction()
    {
        return $this->render("pages/upload.html.twig");
    }

}
