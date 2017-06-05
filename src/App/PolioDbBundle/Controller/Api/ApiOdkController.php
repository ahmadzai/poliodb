<?php

namespace App\PolioDbBundle\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 *
 */
class ApiOdkController extends Controller
{


  /**
   * @Route("api/get/submissions/{slug}", defaults={"slug" = "all"}, name="api_count_submissions")
   */
  public function getSubAction($slug)
  {
      //echo $slug;
      $channel = [];
      $em = $this->getDoctrine()->getManager();
      if($slug == "all") {
          $data = $em->getRepository('AppPolioDbBundle:Submissions')
              ->countAllSubmissions();
          $channel = $this->get('app.chart')->lineChart($data);
      } elseif ($slug == "column") {
          $last_month = date("F", strtotime("last month"));
          $current_month = date("F");
          $data = $em->getRepository('AppPolioDbBundle:Submissions')
              ->count2MonthsSubmissions($last_month, $current_month);
          $channel = $this->get('app.chart')->lineChart($data);
      }
      //return $this->json($channel);
      return new Response(json_encode($channel));
  }

    /**
     * @Route("api/get/countby/{type}", name="api_count_submissions_by")
     * @param $type
     * @return json
     */
  public function countDataByAction($type) {
//      if($type !== "form" || $type !== "title" || $type !== "region")
//          throw $this->createNotFoundException('Bad request!');

      $em = $this->getDoctrine()->getManager();
      $data = $em->getRepository('AppPolioDbBundle:Submissions')
          ->countAllSubmissionsBy($type);
      $channel = $this->get('app.chart')->pieChart($data);
      return new Response(json_encode($channel));
  }

}
