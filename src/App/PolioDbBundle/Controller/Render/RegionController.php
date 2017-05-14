<?php

namespace App\PolioDbBundle\Controller\Render;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;


class RegionController extends Controller
{

    /**
     * @return Response
     * @Route("/admin_data/{region}", name="admin_data_region")
     * @param $region
     */
    public function indexAction($region) {
        $em = $this->getDoctrine()->getManager();
        $data = $em->getRepository('AppPolioDbBundle:ProvinceData')
            ->selectAllRegions();
        if(is_array($data)? !in_array(strtoupper($region), $data): false)
            throw $this->createNotFoundException('Bad request!');
        $data = $em -> getRepository('AppPolioDbBundle:ProvinceData')
            ->selectProvincesByRegion($region);
        return $this->render("pages/admin_data_region.html.twig",
                             ['ajax_url_var'=>$region, 'province' => $data]);
    }
}
