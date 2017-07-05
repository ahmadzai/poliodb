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
use Symfony\Component\HttpKernel\Exception\NotAcceptableHttpException;

class UploadController extends Controller
{

    /**
     * @Route("/upload/admin_data", name="data_upload")
     * @param $table
     * @param $request
     * @return response
     */
     public function uploadAction(Request $request)
     {

       //mapping Db table TempAdminData
       $mappings = $this->getDoctrine()->getManager()->getClassMetadata('AppPolioDbBundle:TempAdminData');
       $fieldNames = $mappings->getFieldNames();

       //remove id auto_increament field from template.
       $remvOption = array('id');
       $new_fields = array_diff($fieldNames, $remvOption);

       //create dynamic template for data source.
       $doc = $this->get('phpexcel')->createPHPExcelObject();
       $doc->setActiveSheetIndex(0);
       $doc->getActiveSheet()->fromArray($new_fields);

       $objWriter = PHPExcel_IOFactory::createWriter($doc, 'Excel2007');
       $objWriter->save('upload/template.xlsx');

       $user = new TempAdminData();

       //create first form of the page.
       $form = $this->createFormBuilder($user)
       ->add('file', FileType::class, array('label' => 'Choose File or Drop-Zone'))
       ->getForm();

       //second form of the page.
       $form2 = $this->get('form.factory')->createNamedBuilder('form2')
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

                   if(is_null($row['A']))
                   $user->setDistrictCode(NULL);
                   else
                   $user->setDistrictCode(trim($row['A']));

                   //check datatype of the filed.
                   if(is_string($row['B']))
                   echo "correct";
                   else {

                     $sql = "TRUNCATE temp_admin_data";
                     $stmt = $em->getConnection()->query($sql);

                     $request->getSession()->getFlashBag()->add('exception', "Check data type of column SubDistName");
                     throw new \Doctrine\DBAL\DBALException;

                   }

                   if(is_null($row['B']))
                   $user->setSubDistName(NULL);
                   else
                   $user->setSubDistName($row['B']);

                   if(is_null($row['C']))
                   $user->setClusterName(NULL);
                   else
                   $user->setClusterName(trim($row['C']));

                   if(is_null($row['D']))
                   $user->setClusterNo(NULL);
                   else
                   $user->setClusterNo(trim($row['D']));

                   if(is_null($row['E']))
                   $user->setCluster(NULL);
                   else
                   $user->setCluster(trim($row['E']));

                   if(is_null($row['F']))
                   $user->setTargetPop(NULL);
                   else
                   $user->setTargetPop(trim($row['F']));

                   if(is_null($row['G']))
                   $user->setGivenVials(NULL);
                   else
                   $user->setGivenVials(trim($row['G']));

                   if(is_null($row['H']))
                   $user->setUsedVials(NULL);
                   else
                   $user->setUsedVials(trim($row['H']));

                   if(is_null($row['I']))
                   $user->setChild011(NULL);
                   else
                   $user->setChild011(trim($row['I']));

                   if(is_null($row['J']))
                   $user->setChild1259(NULL);
                   else
                   $user->setChild1259(trim($row['J']));

                   if(is_null($row['K']))
                   $user->setRegAbsent(NULL);
                   else
                   $user->setRegAbsent(trim($row['K']));

                   if(is_null($row['L']))
                   $user->setVaccAbsent(NULL);
                   else
                   $user->setVaccAbsent(trim($row['L']));

                   if(is_null($row['M']))
                   $user->setRegSleep(NULL);
                   else
                   $user->setRegSleep(trim($row['M']));

                   if(is_null($row['N']))
                   $user->setVaccSleep(NULL);
                   else
                   $user->setVaccSleep(trim($row['N']));

                   if(is_null($row['O']))
                   $user->setRegRefusal(NULL);
                   else
                   $user->setRegRefusal(trim($row['O']));

                   if(is_null($row['P']))
                   $user->setVaccRefusal(NULL);
                   else
                   $user->setVaccRefusal(trim($row['P']));

                   if(is_null($row['Q']))
                   $user->setNewPolioCase(NULL);
                   else
                   $user->setNewPolioCase(trim($row['Q']));

                   if(is_null($row['R']))
                   $user->setVaccDay(NULL);
                   else
                   $user->setVaccDay(trim($row['R']));

                   if(is_null($row['S']))
                   $user->setCampaignId(NULL);
                   else
                   $user->setCampaignId(trim($row['S']));

                   //... and so on

                   $em->persist($user);
                   $em->flush();
                 }
               }//end of foreach

               $request->getSession()->getFlashBag()->add('notice', "Add done!");

             } catch (\Symfony\Component\Debug\Exception\ContextErrorException $e) {
               $request->getSession()->getFlashBag()->add('notice', $e->getMessage());
             }
             catch (\Doctrine\DBAL\DBALException $e) {
               //$request->getSession()->getFlashBag()->add('notice', $e->getMessage());
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

             $request->getSession()->getFlashBag()->add('noticee', "Sync to Master done!");

            } catch (\Symfony\Component\Debug\Exception\ContextErrorException $e) {
             $request->getSession()->getFlashBag()->add('noticee', $e->getMessage());
            }

         }//end of second form.
       }

       return $this->render('html/upload.html.twig', array ('form' => $form->createView(), 'form2' => $form2->createView()));
     }

}
