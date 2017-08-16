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
     * @Route("/download/admin_data", name="admin_data_download")
     */
    public function DashboardAdminDataAction(Request $request)
    {
      // $isAjax = $request->isXmlHttpRequest();

      //track url
      $this->get('app.settings')->trackUrl('admin_data_download');
      $lastCamp = $this->get('app.settings')->latestCampaign('AdminData');
      $lastCampData = $this->get('app.download')->latestCampaignForAdmin($lastCamp[0]['campaignId']);

      $datatable = $this->get('sg_datatables.factory')->create(AdminDataDatatable::class);
      $datatable->buildDatatable();

      $datasource = "admin_data";
      //
      // if ($isAjax) {
      //   $responseService = $this->get('sg_datatables.response');
      //   $responseService->setDatatable($datatable);
      //
      //   $datatableQueryBuilder = $responseService->getDatatableQueryBuilder();
      //   $datatableQueryBuilder->buildQuery();
      //
      //   //dump($datatableQueryBuilder->getQb()->getDQL()); die();
      //
      //   return $responseService->getResponse();
      // }

      return $this->render('download/admindownload.html.twig', array(
        'datatable' => $datatable, 'lastcamp' => json_encode($lastCampData), 'table' => $datasource
      ));
    }

    public function showAction(Post $post)
    {
        return $this->render('post/show.html.twig', array(
            'post' => $post
        ));
    }
    /**
     * @Route("/download/catchup_data", name="catchup_data_download")
     */
    public function DashboardCatchupDataAction(Request $request)
    {
      // $isAjax = $request->isXmlHttpRequest();

      $this->get('app.settings')->trackUrl('catchup_data_download');
      $lastCamp = $this->get('app.settings')->latestCampaign('CatchupData');
      $lastCampData = $this->get('app.download')->latestCampaignForCatchup($lastCamp[0]['campaignId']);

      $datatable = $this->get('sg_datatables.factory')->create(AdminDataDatatable::class);
      $datatable->buildDatatable();

      $datasource = "catchup_data";


      return $this->render('download/catchupdownload.html.twig', array(
        'datatable' => $datatable, 'lastcamp' => json_encode($lastCampData), 'table' => $datasource
      ));
    }

    /**
      * @Route("/download/icm_data", name="icm_data_download")
      */
    public function DashboardIcmDataAction(Request $request)
    {
      // $isAjax = $request->isXmlHttpRequest();

      $this->get('app.settings')->trackUrl('icm_data_download');
      $lastCamp = $this->get('app.settings')->latestCampaign('IcmData');
      $lastCampData = $this->get('app.download')->latestCampaignForIcm($lastCamp[0]['campaignId']);

      $datatable = $this->get('sg_datatables.factory')->create(AdminDataDatatable::class);
      $datatable->buildDatatable();

      $datasource = "icm_data";


      return $this->render('download/icmdownload.html.twig', array(
        'datatable' => $datatable, 'lastcamp' => json_encode($lastCampData), 'table' => $datasource
      ));
    }
}
