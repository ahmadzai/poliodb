<?php

namespace App\PolioDbBundle\Controller;

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
use App\PolioDbBundle\Entity\Campaign;


use Symfony\Component\HttpFoundation\Session\Session;


class DownloadController extends Controller
{

    /**
     * @Route("/download/{table}", name="data_download")
     */
    public function DashboardAdminDataAction(Request $request)
    {
      $isAjax = $request->isXmlHttpRequest();

      // Get your Datatable ...
      //$datatable = $this->get('app.datatable.post');
      //$datatable->buildDatatable();

      // or use the DatatableFactory
      /** @var DatatableInterface $datatable */
      $datatable = $this->get('sg_datatables.factory')->create(AdminDataDatatable::class);
      $datatable->buildDatatable();

      if ($isAjax) {
        $responseService = $this->get('sg_datatables.response');
        $responseService->setDatatable($datatable);

        $datatableQueryBuilder = $responseService->getDatatableQueryBuilder();
        $datatableQueryBuilder->buildQuery();

        //dump($datatableQueryBuilder->getQb()->getDQL()); die();

        return $responseService->getResponse();
      }

      return $this->render('html/download.html.twig', array(
        'datatable' => $datatable,
      ));
    }

    public function showAction(Post $post)
    {
        return $this->render('post/show.html.twig', array(
            'post' => $post
        ));
    }

    /**
     * @Route("/downloadFilter", name="download_filter")
     */

    public function downloadFilterAction()
    {


        $em = $this->getDoctrine()->getManager();

        $campaigns = $em->getRepository('AppPolioDbBundle:Campaign')->findBy([], ['campaignId' => 'DESC']);

        $regions = $em->getRepository('AppPolioDbBundle:Province')->selectAllRegions();

        return $this->render("html/downloadFilter.html.twig", ['campaigns' => $campaigns, 'regions' => $regions]);
    }
}
