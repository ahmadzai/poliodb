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
use App\PolioDbBundle\Entity\AdminData;
use Symfony\Component\HttpFoundation\JsonResponse;

class DataEntryController extends Controller
{

    /**
     * @Route("/data_entry/admin_data", name="entry_admin_data")
     */
    public function DashboardAdminDataAction(Request $request)
    {
      $adminData = new AdminData();
      $form = $this->createForm('App\PolioDbBundle\Form\AdminDataEntryType', $adminData);
      $form->handleRequest($request);

      if ($form->isSubmitted()) {
          $em = $this->getDoctrine()->getManager();
          $em->persist($adminData);
          $em->flush($adminData);


          return new JsonResponse(array('message' => 'Success!'), 200);
          // return $this->redirectToRoute('district_show', array('id' => $district->getDistrictCode()));
      }

    //   $response = new JsonResponse(
    //         array(
    //     'message' => 'Error',
    //     'form' => $this->renderView('dataentry/admin/new.html.twig',
    //             array(
    //               'admindata' => $adminData,
    //               'form' => $form->createView(),
    //     ))), 400);
    //
    // return $response;

    $lastThreeRows = $this->get('app.download')->lastThreeAdminRows();

      return $this->render('dataentry/admin/new.html.twig', array(
          'admindata' => $adminData,
          'form' => $form->createView(),
          'lastthreerows' => json_encode($lastThreeRows)
      ));
    }

    /**
     * @Route("/data_entry/icm_data", name="entry_icm_data")
     */
    public function DashboardIcmDataAction()
    {
        return $this->render("pages/home.html.twig");
    }

    /**
     * @Route("/data_entry/catchup_data", name="entry_catchup_data")
     */
    public function DashboardCatchupDataAction()
    {
        return $this->render("pages/home.html.twig");
    }

    /**
     * @Route("/data_entry/edit/{id}", name="edit_admin_data")
     */
    public function DashboardEditDataAction($id)
    {
        return $this->render("test.html.twig", array(
            'var' => $id
            ));
    }

}
