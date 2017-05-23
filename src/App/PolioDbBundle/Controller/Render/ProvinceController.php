<?php

namespace App\PolioDbBundle\Controller\Render;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;


class ProvinceController extends Controller
{
    /**
     * @return Response
     * @Route("/admin_data/province/{province}", name="admin_data_province")
     * @param $province
     */
    public function indexAction($province) {
        $em = $this->getDoctrine()->getManager();
        $region = $em->getRepository('AppPolioDbBundle:Province')
            ->findOneByProvinceCode($province);
        if(!is_numeric($province) || $province > 34)
            throw $this->createNotFoundException('Bad request!');
        $data = $em -> getRepository('AppPolioDbBundle:DistrictData')
            ->selectDistrictsByProvince($province);
        return $this->render("pages/admin_data_province.html.twig",
            ['ajax_url_var'=>$province, 'back_url'=>$region->getProvinceRegion(), 'district' => $data]);
    }

}
