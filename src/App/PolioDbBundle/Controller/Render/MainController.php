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
     * @Route("/deprecated", name="home_admin_data")
     */
    public function homeAdminDataAction()
    {
        // this function returns latest campaign, can work for all data sources that have relation with campaign
        $lastCamp = $this->get('app.settings')->latestCampaign('AdminData');
        // this function takes two parameters 1:table name to be joined with campaign table, 2: how many campaigns
        // to be returned (optional) by default it returns the last 3 campaigns (only ids)
        $campaignIds = $this->get('app.settings')->lastFewCampaigns('AdminData');

        /**
         * The below method call is a dynamic function returning the data from different data-sources
         * however, you have to define a callMe() function in your Repository Class with the same structure as below
         * Then you would not need to call that function with Doctrine EntityManager, you just call chartData and pass
         * the tableName, functionName, and parameters for the original function in your repository
         */
        $regionAdminData = $this->get('app.chart')->chartData('AdminData', 'regionAgg', $campaignIds);
        $lastCampAdminData = $this->get('app.chart')->chartData('AdminData', 'regionAgg', [$lastCamp[0]['campaignId']]);
        // Category 1 (name must be in the result set)
        // Category 2 (name must be in the result set)
        // Array of columns to show on chart (the index is the label and the value is the column name in the result set
        // Data returned above
        $missedChildChart = $this->get('app.chart')->chartData2Categories('Region', 'CMonth',
            ['Refusal'=>'RemainingRefusal',
                'NSS' => 'RemainingNSS', 'Absent' => 'RemainingAbsent'], $regionAdminData);
        $missedChildChart['title'] = "Remaining children by reasons";
        // For absent children
        $chartDataAbsent = $this->get('app.chart')->chartData2Categories('Region', 'CMonth',
            ['Remaining Absent'=>'RemainingAbsent',
                'Vacc Absent' => 'VaccAbsent'], $regionAdminData);
        $chartDataAbsent['title'] = "Recovering absent children during campaign";
        // For NSS
        $chartDataNss = $this->get('app.chart')->chartData2Categories('Region', 'CMonth',
            ['Remaining NSS'=>'RemainingNSS',
                'Vacc NSS' => 'VaccNSS'], $regionAdminData);
        $chartDataNss['title'] = "Recovering New born, sleep and sick children during campaign";
        // For Refusal
        $chartDataRefusal = $this->get('app.chart')->chartData2Categories('Region', 'CMonth',
            ['Remaining Refusal'=>'RemainingRefusal',
                'Vacc Refusal' => 'VaccRefusal'], $regionAdminData);
        $chartDataRefusal['title'] = "Recovering refusal children during campaign";
        $lastCampVaccUsageChart = $this->get('app.chart')->chartData2Categories('Region', 'CMonth',
                                    ['ReceivedVials'=>'RVials',
                                    'UsedVials' => 'UVials', 'Wastage' => 'VaccWastage'], $regionAdminData);
        $lastCampVaccUsageChart['title'] = "Vaccine usage during last campaign";
        return $this->render("dashboard/admin_data_dashboard.html.twig",
                            ['chart1data' => json_encode($missedChildChart),
                             'chartDataAbsent' => json_encode($chartDataAbsent),
                             'chartDataNss' => json_encode($chartDataNss),
                             'chartDataRefusal' => json_encode($chartDataRefusal),
                             'chartVaccineUsage' => json_encode($lastCampVaccUsageChart),
                             'lastCampData' => $lastCampAdminData]);
    }

    /**
     * @return Response
     * @Route("/testquery", name="test")
     */
    public function testQuery()
    {

        // $this->get('app.chart')->chartData('entityName', 'functionName', 'parametersArray');
        $data = $this->get('app.chart')->chartData('AdminData', 'clusterAgg', [14, 15], [3301,3302]);
        // Category 1 (name must be in the result set)
        // Category 2 (name must be in the result set)
        // Array of columns to show on chart (the index is the label and the value is the column name in the result set
        // Data returned above
//        $data = $this->get('app.chart')->chartData2Categories('Region', 'CID',
//            ['ReceivedVials'=>'RVials',
//                'UsedVials' => 'UVials', 'VaccWastage' => 'VaccWastage'], $data);
        //$data = $this->get('app.settings')->campaignLatest('AdminData', 0);
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

          $mappings = $this->getDoctrine()->getManager()->getClassMetadata('AppPolioDbBundle:TempAdminData');
          $fieldNames = $mappings->getFieldNames();


          //$doc = new PHPExcel();

          // set active sheet
          //$doc->setActiveSheetIndex(0);

          //$doc->getActiveSheet()->fromArray($fieldNames);
          //$filename = 'just_some_random_name.xls';

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

        return $this->render('pages/upload1.html.twig', array ('form' => $form->createView(), 'column' => $fieldNames));
    }

}
