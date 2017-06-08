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
        return $this->render("html/admin_data.html.twig", ['ajax_url_var'=>'all', 'data' => $data]);
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
    public function uploadAction(Request $request)
    {

    /**  $path_file = __DIR__. '\Book1.xlsx';
      //$excelObj = PHPExcel_IOFactory::load($path_file);
      $excelObj = $this->get('phpexcel')->createPHPExcelObject($path_file);
      $sheet = $excelObj->getActiveSheet()->toArray(null,true,true,true);

      $em = $this->getDoctrine()->getManager();

      //READ EXCEL FILE CONTENT
      foreach($sheet as $i=>$row) {
          if($i !== 1) {

          $account = $em->getRepository('AppPolioDbBundle:Testdata')->findOneByusername($row['A']);
                   //if(!$account) {
                       $user = new Testdata();
          // }

                   $user->setUserName($row['A']);
                   $user->setEmail($row['B']);
                   //$user->setEmail($row['C']);
                   //... and so on


                   $em->persist($user);
                   $em->flush();
      }
 }**/


        // replace this example code with whatever you need
        $user = new TempAdminData();

        //$path_file = $user->getFile();

        $form = $this->createFormBuilder($user)
        //->add('username',  TextType::class)
        //->add('email',  TextType::class)
        /**->add('regions', EntityType::class, array(
          'class' => 'AppPolioDbBundle:Province',
          'query_builder' => function (EntityRepository $er) {
            return $er->createQueryBuilder('u')
            ->groupBy('u.provinceRegion');
         },
      ))*/
      ->add('file', FileType::class, array('label' => 'Choose File or Drop-Zone'))
        //->add('textarea1', TextareaType::class)
        ->getForm();
        //$form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            //get data

          //  $file = $user->getBrochure();

              //$em = $this->getDoctrine()->getManager();

              $path_file = $user->getFile();
              //$excelObj = PHPExcel_IOFactory::load($path_file);
              $excelObj = $this->get('phpexcel')->createPHPExcelObject($path_file);
              $sheet = $excelObj->getActiveSheet()->toArray(null,true,true,true);

              $em = $this->getDoctrine()->getManager();

              //READ EXCEL FILE CONTENT
              foreach($sheet as $i=>$row) {
                  //if($i !== 1) {

                  //$account = $em->getRepository('AppPolioDbBundle:Testdata')->findOneByusername($row['A']);
                           //if(!$account) {
                           $user = new TempAdminData();

                             //}
                           $user->setDistrictCode(trim($row['A']));
                           $user->setSubDistName(trim($row['B']));
                           $user->setClusterName(trim($row['C']));
                           $user->setClusterNo(trim($row['D']));
                           $user->setCluster(trim($row['E']));
                           $user->setTargetPop(trim($row['F']));
                           $user->setGivenVials(trim($row['G']));
                           $user->setUsedVials(trim($row['H']));
                           $user->setChild011(trim($row['I']));
                           $user->setChild1259(trim($row['J']));
                           $user->setRegAbsent(trim($row['K']));
                           $user->setVaccAbsent(trim($row['L']));
                           $user->setRegSleep(trim($row['M']));
                           $user->setVaccSleep(trim($row['N']));
                           $user->setRegRefusal(trim($row['O']));
                           $user->setVaccRefusal(trim($row['P']));
                           $user->setNewPolioCase(trim($row['Q']));
                           $user->setVaccDay(trim($row['R']));
                           $user->setCampaignId(trim($row['S']));
                           //... and so on

                           $em->persist($user);
                           $em->flush();

                  //}
                }
                $this->addFlash(
                    'notice',
                        'Your data has been loaded to DB!'
                      );

                //$user = new Testdata();

                  //}
                //$region = $form['regions']->getData();
                //$user->setRegions($region);
            //$username = $form['username']->getData();
            //$email = $form['email']->getData();

            //$user->setUsername($username);
            //$user->setEmail($email);

        }

        return $this->render('pages/upload1.html.twig', array ('form' => $form->createView()));
    }

}
