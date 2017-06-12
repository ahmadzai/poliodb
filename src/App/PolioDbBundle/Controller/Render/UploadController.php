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
use PHPExcel_IOFactory;

class UploadController extends Controller
{

    /**
     * @Route("/upload/{table}", name="data_upload")
     * @param $table
     */
    public function uploadAction(Request $request, $table)
    {


        $mappings = $this->getDoctrine()->getManager()->getClassMetadata('AppPolioDbBundle:TempAdminData');
        $fieldNames = $mappings->getFieldNames();
      /**  $upp = [];
        foreach ($fieldNames as $value) {
            $upp[] = ucfirst($value);
        }*/





        $doc = $this->get('phpexcel')->createPHPExcelObject();
        $doc->setActiveSheetIndex(0);
        $doc->getActiveSheet()->fromArray($fieldNames);

        $objWriter = PHPExcel_IOFactory::createWriter($doc, 'Excel2007');
        //$objWriter->save(str_replace(__FILE__,'C:\xampp\htdocs\poliodb\web\upload',__FILE__));
        $objWriter->save('upload/template.xlsx');

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
                  if($i !== 1) {

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

                  }
                }
                $this->addFlash(
                    'notice',
                        'Your data has been loaded to DB!'
                      );


        }

        return $this->render('html/upload.html.twig', array ('form' => $form->createView()));
    }

}
