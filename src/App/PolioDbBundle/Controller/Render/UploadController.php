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
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use PHPExcel_IOFactory;

class UploadController extends Controller
{

    /**
     * @Route("/upload/{table}", name="data_upload")
     * @param $table
     */
     public function uploadAction(Request $request, $table)
     {

       //mapping Db table TempAdminData
       $mappings = $this->getDoctrine()->getManager()->getClassMetadata('AppPolioDbBundle:TempAdminData');
       $fieldNames = $mappings->getFieldNames();

       $remvOption = array('id');
       $new_fields = array_diff($fieldNames, $remvOption);


       $doc = $this->get('phpexcel')->createPHPExcelObject();
       $doc->setActiveSheetIndex(0);
       $doc->getActiveSheet()->fromArray($new_fields);

       $objWriter = PHPExcel_IOFactory::createWriter($doc, 'Excel2007');
       //$objWriter->save(str_replace(__FILE__,'C:\xampp\htdocs\poliodb\web\upload',__FILE__));
       $objWriter->save('upload/template.xlsx');



       $user = new TempAdminData();

       //first form of the page.
       $form = $this->createFormBuilder($user)
       ->add('file', FileType::class, array('label' => 'Choose File or Drop-Zone'))
       ->getForm();

       //second form of the page.
       $form2 = $this->get('form.factory')->createNamedBuilder('form2')
       //->add('submit', SubmitType::class, array('attr' => array('class' => 'btn btn-success')))
       ->getForm();


       if('POST' === $request->getMethod()) {

         if ($request->request->has('form')) {

           $form->handleRequest($request);
           if($form->isSubmitted() && $form->isValid()){

             $path_file = $user->getFile();
             $excelObj = $this->get('phpexcel')->createPHPExcelObject($path_file);
             $sheet = $excelObj->getActiveSheet()->toArray(null,true,true,true);
             $em = $this->getDoctrine()->getManager();

             //READ EXCEL FILE CONTENT

             try {

               foreach($sheet as $i=>$row) {
                 if($i !== 1) {

                   $user = new TempAdminData();

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
                 }
               }//end of foreach

               //$this->get('session')->addFlash('flash_key',"Add done!");
               $request->getSession()->getFlashBag()->add('notice', "Add done!");

             } catch (\Symfony\Component\Debug\Exception\ContextErrorException $e) {
               $request->getSession()->getFlashBag()->add('notice', $e->getMessage());
             }
             catch (\Doctrine\DBAL\DBALException $e) {
               $request->getSession()->getFlashBag()->add('notice', $e->getMessage());
             }
           }

         }//end of handling first form.

         if ($request->request->has('form2')) {

           $form2->handleRequest($request);

           $sql = "
           INSERT INTO admin_data(district_code, sub_district_name, cluster_name, cluster_no, cluster, target_population, used_vials, child_0_11, child_12_59, reg_absent, vacc_absent, reg_sleep, vacc_sleep, reg_refusal,vacc_refusal, new_polio_case, vacc_day, campaign_id) SELECT districtCode, subDistName, clusterName, clusterNo, cluster, targetPop, usedVials, child011, child1259, regAbsent, vaccAbsent, regSleep, vaccSleep,regRefusal, vaccRefusal, newPolioCase, vaccDay, campaignId FROM temp_admin_data
           ";
           $sql1 = "TRUNCATE temp_admin_data";

           try {

             $em = $this->getDoctrine()->getManager();
             $stmt = $em->getConnection()->query($sql);
             $stmtt = $em->getConnection()->query($sql1);

             $request->getSession()->getFlashBag()->add('noticee', "Add done!");

           } catch (\Symfony\Component\Debug\Exception\ContextErrorException $e) {
             $request->getSession()->getFlashBag()->add('noticee', $e->getMessage());
           }

         }//end of second form.
       }

       return $this->render('html/upload.html.twig', array ('form' => $form->createView(), 'form2' => $form2->createView()));
     }

}
