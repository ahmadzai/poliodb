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
use App\PolioDbBundle\Entity\TempIcmData;
use App\PolioDbBundle\Entity\TempCatchupData;
class UploadController extends Controller
{
    /**
     * @Route("/upload/admin_data", name="admin_data_upload")
     */
    public function adminUploadAction(Request $request)
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
        $objWriter->save('upload/admin_data_template.xlsx');
        $datasource = "admin_data";
        $user = new TempAdminData();
        //create first form of the page.
        $form = $this->createFormBuilder($user)
            ->add('file', FileType::class, array('label' => 'Choose File or Drop-Zone'))
            ->getForm();
        $syncbuttonbool = "disabled";
        $uploadbuttonbool = "";
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
                                $campaignrecord = $stmtt = $em->getRepository('AppPolioDbBundle:AdminData')
                                    ->checkThreeDayCampaign();
                                if ($campaignrecord == NULL) {
                                    $request->getSession()->getFlashBag()->add('datatype_exception', "Please insert data from day 1,2,3 of the current campaign.");
                                    throw new \Doctrine\DBAL\DBALException;
                                }
                                //check datatype of the filed.
                                if(is_double($row['A']) || is_null($row['A']))
                                    echo "";
                                else {
                                    $stmtt = $em->getRepository('AppPolioDbBundle:TempAdminData')
                                        ->truncatTempAdminData();
                                    $request->getSession()->getFlashBag()->add('datatype_exception', "Check data type of column DistrictCode");
                                    throw new \Doctrine\DBAL\DBALException;
                                }
                                if(is_null($row['A']))
                                    $user->setDistrictCode(NULL);
                                else
                                    $user->setDistrictCode(trim($row['A']));
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
                                //check datatype of the filed.
                                if(is_double($row['G']) || is_null($row['G']))
                                    echo "";
                                else {
                                    $stmtt = $em->getRepository('AppPolioDbBundle:TempAdminData')
                                        ->truncatTempAdminData();
                                    $request->getSession()->getFlashBag()->add('datatype_exception', "Check data type of column GivenVials");
                                    throw new \Doctrine\DBAL\DBALException;
                                }
                                if(is_null($row['G']))
                                    $user->setGivenVials(NULL);
                                else
                                    $user->setGivenVials(trim($row['G']));
                                //check datatype of the filed.
                                if(is_double($row['H']) || is_null($row['H']))
                                    echo "";
                                else {
                                    $stmtt = $em->getRepository('AppPolioDbBundle:TempAdminData')
                                        ->truncatTempAdminData();
                                    $request->getSession()->getFlashBag()->add('datatype_exception', "Check data type of column UsedVials");
                                    throw new \Doctrine\DBAL\DBALException;
                                }
                                if(is_null($row['H']))
                                    $user->setUsedVials(NULL);
                                else
                                    $user->setUsedVials(trim($row['H']));
                                //check datatype of the filed.
                                if(is_double($row['I']) || is_null($row['I']))
                                    echo "";
                                else {
                                    $stmtt = $em->getRepository('AppPolioDbBundle:TempAdminData')
                                        ->truncatTempAdminData();
                                    $request->getSession()->getFlashBag()->add('datatype_exception', "Check data type of column Child001");
                                    throw new \Doctrine\DBAL\DBALException;
                                }
                                if(is_null($row['I']))
                                    $user->setChild011(NULL);
                                else
                                    $user->setChild011(trim($row['I']));
                                //check datatype of the filed.
                                if(is_double($row['J']) || is_null($row['J']))
                                    echo "";
                                else {
                                    $stmtt = $em->getRepository('AppPolioDbBundle:TempAdminData')
                                        ->truncatTempAdminData();
                                    $request->getSession()->getFlashBag()->add('datatype_exception', "Check data type of column Child1259");
                                    throw new \Doctrine\DBAL\DBALException;
                                }
                                if(is_null($row['J']))
                                    $user->setChild1259(NULL);
                                else
                                    $user->setChild1259(trim($row['J']));
                                //check datatype of the filed.
                                if(is_double($row['K']) || is_null($row['K']))
                                    echo "";
                                else {
                                    $stmtt = $em->getRepository('AppPolioDbBundle:TempAdminData')
                                        ->truncatTempAdminData();
                                    $request->getSession()->getFlashBag()->add('datatype_exception', "Check data type of column RegAbsent");
                                    throw new \Doctrine\DBAL\DBALException;
                                }
                                if(is_null($row['K']))
                                    $user->setRegAbsent(NULL);
                                else
                                    $user->setRegAbsent(trim($row['K']));
                                //check datatype of the filed.
                                if(is_double($row['L']) || is_null($row['L']))
                                    echo "";
                                else {
                                    $stmtt = $em->getRepository('AppPolioDbBundle:TempAdminData')
                                        ->truncatTempAdminData();
                                    $request->getSession()->getFlashBag()->add('datatype_exception', "Check data type of column VaccAbsent");
                                    throw new \Doctrine\DBAL\DBALException;
                                }
                                if(is_null($row['L']))
                                    $user->setVaccAbsent(NULL);
                                else
                                    $user->setVaccAbsent(trim($row['L']));
                                //check datatype of the filed.
                                if(is_double($row['M']) || is_null($row['M']))
                                    echo "";
                                else {
                                    $stmtt = $em->getRepository('AppPolioDbBundle:TempAdminData')
                                        ->truncatTempAdminData();
                                    $request->getSession()->getFlashBag()->add('datatype_exception', "Check data type of column RegSleep");
                                    throw new \Doctrine\DBAL\DBALException;
                                }
                                if(is_null($row['M']))
                                    $user->setRegSleep(NULL);
                                else
                                    $user->setRegSleep(trim($row['M']));
                                //check datatype of the filed.
                                if(is_double($row['N']) || is_null($row['N']))
                                    echo "";
                                else {
                                    $stmtt = $em->getRepository('AppPolioDbBundle:TempAdminData')
                                        ->truncatTempAdminData();
                                    $request->getSession()->getFlashBag()->add('datatype_exception', "Check data type of column VaccSleep");
                                    throw new \Doctrine\DBAL\DBALException;
                                }
                                if(is_null($row['N']))
                                    $user->setVaccSleep(NULL);
                                else
                                    $user->setVaccSleep(trim($row['N']));
                                //check datatype of the filed.
                                if(is_double($row['O']) || is_null($row['O']))
                                    echo "";
                                else {
                                    $stmtt = $em->getRepository('AppPolioDbBundle:TempAdminData')
                                        ->truncatTempAdminData();
                                    $request->getSession()->getFlashBag()->add('datatype_exception', "Check data type of column RegRefusal");
                                    throw new \Doctrine\DBAL\DBALException;
                                }
                                if(is_null($row['O']))
                                    $user->setRegRefusal(NULL);
                                else
                                    $user->setRegRefusal(trim($row['O']));
                                //check datatype of the filed.
                                if(is_double($row['P']) || is_null($row['P']))
                                    echo "";
                                else {
                                    $stmtt = $em->getRepository('AppPolioDbBundle:TempAdminData')
                                        ->truncatTempAdminData();
                                    $request->getSession()->getFlashBag()->add('datatype_exception', "Check data type of column VaccRefusal");
                                    throw new \Doctrine\DBAL\DBALException;
                                }
                                if(is_null($row['P']))
                                    $user->setVaccRefusal(NULL);
                                else
                                    $user->setVaccRefusal(trim($row['P']));
                                //check datatype of the filed.
                                if(is_double($row['Q']) || is_null($row['Q']))
                                    echo "";
                                else {
                                    $stmtt = $em->getRepository('AppPolioDbBundle:TempAdminData')
                                        ->truncatTempAdminData();
                                    $request->getSession()->getFlashBag()->add('datatype_exception', "Check data type of column NewPolioCase");
                                    throw new \Doctrine\DBAL\DBALException;
                                }
                                if(is_null($row['Q']))
                                    $user->setNewPolioCase(NULL);
                                else
                                    $user->setNewPolioCase(trim($row['Q']));
                                //check datatype of the filed.
                                if(is_double($row['R']) || is_null($row['R']))
                                    echo "";
                                else {
                                    $stmtt = $em->getRepository('AppPolioDbBundle:TempAdminData')
                                        ->truncatTempAdminData();
                                    $request->getSession()->getFlashBag()->add('datatype_exception', "Check data type of column VaccDay");
                                    throw new \Doctrine\DBAL\DBALException;
                                }
                                if(is_null($row['R']))
                                    $user->setVaccDay(NULL);
                                else
                                    $user->setVaccDay(trim($row['R']));
                                //check datatype of the filed.
                                if(is_double($row['S']) || is_null($row['S']))
                                    echo "";
                                else {
                                    $stmtt = $em->getRepository('AppPolioDbBundle:TempAdminData')
                                        ->truncatTempAdminData();
                                    $request->getSession()->getFlashBag()->add('datatype_exception', "Check data type of column CampaignId");
                                    throw new \Doctrine\DBAL\DBALException;
                                }
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
                        $syncbuttonbool = "";
                        $uploadbuttonbool = "disabled";
                    }
                    catch (\Doctrine\DBAL\DBALException $e) {
                        //$request->getSession()->getFlashBag()->add('notice', $e->getMessage());
                    }
                }
            }//end of handling first form.
            if ($request->request->has('form2')) {
                $form2->handleRequest($request);
                try {
                    $em = $this->getDoctrine()->getManager();
                    $stmt = $em->getRepository('AppPolioDbBundle:TempAdminData')
                        ->adminSyncToMaster();
                    $stmtt = $em->getRepository('AppPolioDbBundle:TempAdminData')
                        ->truncatTempAdminData();
                    $request->getSession()->getFlashBag()->add('noticee', "Sync to Master done!");
                } catch (\Symfony\Component\Debug\Exception\ContextErrorException $e) {
                    $request->getSession()->getFlashBag()->add('noticee', $e->getMessage());
                }
                catch (\Doctrine\DBAL\Exception\ForeignKeyConstraintViolationException $e) {
                    $request->getSession()->getFlashBag()->add('masterexception', "Please check you data on CompaignId and districtCode, upload your file again.");
                    $stmtt = $em->getRepository('AppPolioDbBundle:TempAdminData')
                        ->truncatTempAdminData();
                }
            }//end of second form.
        }
        return $this->render('html/upload.html.twig', array ('form' => $form->createView(), 'form2' => $form2->createView(), 'table' => $datasource,
            'syncbutt' => $syncbuttonbool, 'uploadbutt' => $uploadbuttonbool));
    }
    /**
     * @Route("/upload/icm_data", name="icm_data_upload")
     */
    public function icmUploadAction(Request $request)
    {
        //mapping Db table TempAdminData
        $mappings = $this->getDoctrine()->getManager()->getClassMetadata('AppPolioDbBundle:TempIcmData');
        $fieldNames = $mappings->getFieldNames();
        //remove id auto_increament field from template.
        $remvOption = array('data_id');
        $new_fields = array_diff($fieldNames, $remvOption);
        //create dynamic template for data source.
        $doc = $this->get('phpexcel')->createPHPExcelObject();
        $doc->setActiveSheetIndex(0);
        $doc->getActiveSheet()->fromArray($new_fields);
        $objWriter = PHPExcel_IOFactory::createWriter($doc, 'Excel2007');
        $objWriter->save('upload/icm_data_template.xlsx');
        $datasource = "icm_data";
        $icmobj = new TempIcmData();
        //create first form of the page.
        $form = $this->createFormBuilder($icmobj)
            ->add('file', FileType::class, array('label' => 'Choose File or Drop-Zone'))
            ->getForm();
        $syncbuttonbool = "disabled";
        $uploadbuttonbool = "";
        //second form of the page.
        $form2 = $this->get('form.factory')->createNamedBuilder('form2')
            ->getForm();
        if('POST' === $request->getMethod()) {
            if ($request->request->has('form')) {
                $form->handleRequest($request);
                if($form->isSubmitted() && $form->isValid()){
                    $path_file = $icmobj->getFile();
                    $excelObj = $this->get('phpexcel')->createPHPExcelObject($path_file);
                    $sheet = $excelObj->getActiveSheet()->toArray(null,true,true,true);
                    $em = $this->getDoctrine()->getManager();
                    //READ EXCEL FILE CONTENT
                    try {
                        foreach($sheet as $i=>$row) {
                            if($i !== 1) {
                                $user = new TempIcmData();
                                //check datatype of the filed.
                                if(is_double($row['A']) || is_null($row['A']))
                                    echo "";
                                else {
                                    $stmtt = $em->getRepository('AppPolioDbBundle:TempIcmData')
                                        ->truncatTempIcmData();
                                    $request->getSession()->getFlashBag()->add('datatype_exception', "Check data type of column DistrictCode");
                                    throw new \Doctrine\DBAL\DBALException;
                                }
                                if(is_null($row['A']))
                                    $user->setDistrictCode(NULL);
                                else
                                    $user->setDistrictCode(trim($row['A']));
                                //check datatype of the filed.
                                if(is_double($row['B']) || is_null($row['B']))
                                    echo "";
                                else {
                                    $stmtt = $em->getRepository('AppPolioDbBundle:TempIcmData')
                                        ->truncatTempIcmData();
                                    $request->getSession()->getFlashBag()->add('datatype_exception', "Check data type of column NoTeamMonitored");
                                    throw new \Doctrine\DBAL\DBALException;
                                }
                                if(is_null($row['B']))
                                    $user->setNoTeamMonitored(NULL);
                                else
                                    $user->setNoTeamMonitored($row['B']);
                                //check datatype of the filed.
                                if(is_double($row['C']) || is_null($row['C']))
                                    echo "";
                                else {
                                    $stmtt = $em->getRepository('AppPolioDbBundle:TempIcmData')
                                        ->truncatTempIcmData();
                                    $request->getSession()->getFlashBag()->add('datatype_exception', "Check data type of column TeamResidentArea");
                                    throw new \Doctrine\DBAL\DBALException;
                                }
                                if(is_null($row['C']))
                                    $user->setTeamResidentArea(NULL);
                                else
                                    $user->setTeamResidentArea(trim($row['C']));
                                //check datatype of the filed.
                                if(is_double($row['D']) || is_null($row['D']))
                                    echo "";
                                else {
                                    $stmtt = $em->getRepository('AppPolioDbBundle:TempIcmData')
                                        ->truncatTempIcmData();
                                    $request->getSession()->getFlashBag()->add('datatype_exception', "Check data type of column VaccinatorTrained");
                                    throw new \Doctrine\DBAL\DBALException;
                                }
                                if(is_null($row['D']))
                                    $user->setVaccinatorTrained(NULL);
                                else
                                    $user->setVaccinatorTrained(trim($row['D']));
                                //check datatype of the filed.
                                if(is_double($row['E']) || is_null($row['E']))
                                    echo "";
                                else {
                                    $stmtt = $em->getRepository('AppPolioDbBundle:TempIcmData')
                                        ->truncatTempIcmData();
                                    $request->getSession()->getFlashBag()->add('datatype_exception', "Check data type of column VaccStage3");
                                    throw new \Doctrine\DBAL\DBALException;
                                }
                                if(is_null($row['E']))
                                    $user->setVaccStage3(NULL);
                                else
                                    $user->setVaccStage3(trim($row['E']));
                                //check datatype of the filed.
                                if(is_double($row['F']) || is_null($row['F']))
                                    echo "";
                                else {
                                    $stmtt = $em->getRepository('AppPolioDbBundle:TempIcmData')
                                        ->truncatTempIcmData();
                                    $request->getSession()->getFlashBag()->add('datatype_exception', "Check data type of column TeamSupervised");
                                    throw new \Doctrine\DBAL\DBALException;
                                }
                                if(is_null($row['F']))
                                    $user->setTeamSupervised(NULL);
                                else
                                    $user->setTeamSupervised(trim($row['F']));
                                //check datatype of the filed.
                                if(is_double($row['G']) || is_null($row['G']))
                                    echo "";
                                else {
                                    $stmtt = $em->getRepository('AppPolioDbBundle:TempIcmData')
                                        ->truncatTempIcmData();
                                    $request->getSession()->getFlashBag()->add('datatype_exception', "Check data type of column TeamWithChW");
                                    throw new \Doctrine\DBAL\DBALException;
                                }
                                if(is_null($row['G']))
                                    $user->setTeamWithChw(NULL);
                                else
                                    $user->setTeamWithChw(trim($row['G']));
                                //check datatype of the filed.
                                if(is_double($row['H']) || is_null($row['H']))
                                    echo "";
                                else {
                                    $stmtt = $em->getRepository('AppPolioDbBundle:TempIcmData')
                                        ->truncatTempIcmData();
                                    $request->getSession()->getFlashBag()->add('datatype_exception', "Check data type of column TeamWithFemale");
                                    throw new \Doctrine\DBAL\DBALException;
                                }
                                if(is_null($row['H']))
                                    $user->setTeamWithFemale(NULL);
                                else
                                    $user->setTeamWithFemale(trim($row['H']));
                                //check datatype of the filed.
                                if(is_double($row['I']) || is_null($row['I']))
                                    echo "";
                                else {
                                    $stmtt = $em->getRepository('AppPolioDbBundle:TempIcmData')
                                        ->truncatTempIcmData();
                                    $request->getSession()->getFlashBag()->add('datatype_exception', "Check data type of column TeamAccomSm");
                                    throw new \Doctrine\DBAL\DBALException;
                                }
                                if(is_null($row['I']))
                                    $user->setTeamAccomSm(NULL);
                                else
                                    $user->setTeamAccomSm(trim($row['I']));
                                //check datatype of the filed.
                                if(is_double($row['J']) || is_null($row['J']))
                                    echo "";
                                else {
                                    $stmtt = $em->getRepository('AppPolioDbBundle:TempIcmData')
                                        ->truncatTempIcmData();
                                    $request->getSession()->getFlashBag()->add('datatype_exception', "Check data type of column NoMissedNoTeamVisit");
                                    throw new \Doctrine\DBAL\DBALException;
                                }
                                if(is_null($row['J']))
                                    $user->setNoMissedNoTeamVisit(NULL);
                                else
                                    $user->setNoMissedNoTeamVisit(trim($row['J']));
                                //check datatype of the filed.
                                if(is_double($row['K']) || is_null($row['K']))
                                    echo "";
                                else {
                                    $stmtt = $em->getRepository('AppPolioDbBundle:TempIcmData')
                                        ->truncatTempIcmData();
                                    $request->getSession()->getFlashBag()->add('datatype_exception', "Check data type of column NoChildSeen");
                                    throw new \Doctrine\DBAL\DBALException;
                                }
                                if(is_null($row['K']))
                                    $user->setNoChildSeen(NULL);
                                else
                                    $user->setNoChildSeen(trim($row['K']));
                                //check datatype of the filed.
                                if(is_double($row['L']) || is_null($row['L']))
                                    echo "";
                                else {
                                    $stmtt = $em->getRepository('AppPolioDbBundle:TempIcmData')
                                        ->truncatTempIcmData();
                                    $request->getSession()->getFlashBag()->add('datatype_exception', "Check data type of column NoChildWithFm");
                                    throw new \Doctrine\DBAL\DBALException;
                                }
                                if(is_null($row['L']))
                                    $user->setNoChildWithFm(NULL);
                                else
                                    $user->setNoChildWithFm(trim($row['L']));
                                //check datatype of the filed.
                                if(is_double($row['M']) || is_null($row['M']))
                                    echo "";
                                else {
                                    $stmtt = $em->getRepository('AppPolioDbBundle:TempIcmData')
                                        ->truncatTempIcmData();
                                    $request->getSession()->getFlashBag()->add('datatype_exception', "Check data type of column NoMissedChild");
                                    throw new \Doctrine\DBAL\DBALException;
                                }
                                if(is_null($row['M']))
                                    $user->setNoMissedChild(NULL);
                                else
                                    $user->setNoMissedChild(trim($row['M']));
                                //check datatype of the filed.
                                if(is_double($row['N']) || is_null($row['N']))
                                    echo "";
                                else {
                                    $stmtt = $em->getRepository('AppPolioDbBundle:TempIcmData')
                                        ->truncatTempIcmData();
                                    $request->getSession()->getFlashBag()->add('datatype_exception', "Check data type of column NoMissed10");
                                    throw new \Doctrine\DBAL\DBALException;
                                }
                                if(is_null($row['N']))
                                    $user->setNoMissed10(NULL);
                                else
                                    $user->setNoMissed10(trim($row['N']));
                                //check datatype of the filed.
                                if(is_double($row['O']) || is_null($row['O']))
                                    echo "";
                                else {
                                    $stmtt = $em->getRepository('AppPolioDbBundle:TempIcmData')
                                        ->truncatTempIcmData();
                                    $request->getSession()->getFlashBag()->add('datatype_exception', "Check data type of column CampaignId");
                                    throw new \Doctrine\DBAL\DBALException;
                                }
                                if(is_null($row['O']))
                                    $user->setCampaignId(NULL);
                                else
                                    $user->setCampaignId(trim($row['O']));
                                //... and so on
                                $em->persist($user);
                                $em->flush();
                            }
                        }//end of foreach
                        $request->getSession()->getFlashBag()->add('notice', "Add done!");
                        $syncbuttonbool = "";
                        $uploadbuttonbool = "disabled";
                    } catch (\Symfony\Component\Debug\Exception\ContextErrorException $e) {
                        $request->getSession()->getFlashBag()->add('exception', $e->getMessage());
                    }
                    catch (\Doctrine\DBAL\DBALException $e) {
                        //$request->getSession()->getFlashBag()->add('notice', $e->getMessage());
                    }
                }
            }//end of handling first form.
            if ($request->request->has('form2')) {
                $form2->handleRequest($request);
                try {
                    $em = $this->getDoctrine()->getManager();
                    $stmt = $em->getRepository('AppPolioDbBundle:TempIcmData')
                        ->icmSyncToMaster();
                    $stmtt = $em->getRepository('AppPolioDbBundle:TempIcmData')
                        ->truncatTempIcmData();
                    $request->getSession()->getFlashBag()->add('noticee', "Sync to Master done!");
                } catch (\Symfony\Component\Debug\Exception\ContextErrorException $e) {
                    $request->getSession()->getFlashBag()->add('noticee', $e->getMessage());
                }
                catch (\Doctrine\DBAL\DBALException $e) {
                    $request->getSession()->getFlashBag()->add('masterexception', "Please check you data on CompaignId and districtCode, upload your file again.");
                    $stmtt = $em->getRepository('AppPolioDbBundle:TempIcmData')
                        ->truncatTempIcmData();
                }
            }//end of second form.
        }
        return $this->render('html/upload.html.twig', array ('form' => $form->createView(), 'form2' => $form2->createView(), 'table' => $datasource,
            'syncbutt' => $syncbuttonbool, 'uploadbutt' => $uploadbuttonbool));
    }
    /**
     * @Route("/upload/catchup_data", name="catchup_data_upload")
     */
    public function catchupUploadAction(Request $request)
    {
        //mapping Db table TempAdminData
        $mappings = $this->getDoctrine()->getManager()->getClassMetadata('AppPolioDbBundle:TempCatchupData');
        $fieldNames = $mappings->getFieldNames();
        //remove id auto_increament field from template.
        $remvOption = array('id');
        $new_fields = array_diff($fieldNames, $remvOption);
        //create dynamic template for data source.
        $doc = $this->get('phpexcel')->createPHPExcelObject();
        $doc->setActiveSheetIndex(0);
        $doc->getActiveSheet()->fromArray($new_fields);
        $objWriter = PHPExcel_IOFactory::createWriter($doc, 'Excel2007');
        $objWriter->save('upload/catchup_data_template.xlsx');
        $datasource = "catchup_data";
        $icmobj = new TempCatchupData();
        //create first form of the page.
        $form = $this->createFormBuilder($icmobj)
            ->add('file', FileType::class, array('label' => 'Choose File or Drop-Zone'))
            ->getForm();
        $syncbuttonbool = "disabled";
        $uploadbuttonbool = "";
        //second form of the page.
        $form2 = $this->get('form.factory')->createNamedBuilder('form2')
            ->getForm();
        if('POST' === $request->getMethod()) {
            if ($request->request->has('form')) {
                $form->handleRequest($request);
                if($form->isSubmitted() && $form->isValid()){
                    $path_file = $icmobj->getFile();
                    $excelObj = $this->get('phpexcel')->createPHPExcelObject($path_file);
                    $sheet = $excelObj->getActiveSheet()->toArray(null,true,true,true);
                    $em = $this->getDoctrine()->getManager();
                    //READ EXCEL FILE CONTENT
                    try {
                        foreach($sheet as $i=>$row) {
                            if($i !== 1) {
                                $user = new TempCatchupData();
                                if(is_null($row['A']))
                                    $user->setSubDistrictName(NULL);
                                else
                                    $user->setSubDistrictName(trim($row['A']));
                                //check datatype of the filed.
                                if(is_double($row['B']) || is_null($row['B']))
                                    echo "";
                                else {
                                    $stmtt = $em->getRepository('AppPolioDbBundle:TempCatchupData')
                                        ->truncatTempCatchupData();
                                    $request->getSession()->getFlashBag()->add('datatype_exception', "Check data type of column DistrictCode");
                                    throw new \Doctrine\DBAL\DBALException;
                                }
                                if(is_null($row['B']))
                                    $user->setDistrictCode(NULL);
                                else
                                    $user->setDistrictCode($row['B']);
                                if(is_null($row['C']))
                                    $user->setClusterName(NULL);
                                else
                                    $user->setClusterName(trim($row['C']));
                                if(is_null($row['D']))
                                    $user->setClusterNo(NULL);
                                else
                                    $user->setClusterNo(trim($row['D']));
                                //check datatype of the filed.
                                if(is_double($row['E']) || is_null($row['E']))
                                    echo "";
                                else {
                                    $stmtt = $em->getRepository('AppPolioDbBundle:TempCatchupData')
                                        ->truncatTempCatchupData();
                                    $request->getSession()->getFlashBag()->add('datatype_exception', "Check data type of column RegAbsent");
                                    throw new \Doctrine\DBAL\DBALException;
                                }
                                if(is_null($row['E']))
                                    $user->setRegAbsent(NULL);
                                else
                                    $user->setRegAbsent(trim($row['E']));
                                //check datatype of the filed.
                                if(is_double($row['F']) || is_null($row['F']))
                                    echo "";
                                else {
                                    $stmtt = $em->getRepository('AppPolioDbBundle:TempCatchupData')
                                        ->truncatTempCatchupData();
                                    $request->getSession()->getFlashBag()->add('datatype_exception', "Check data type of column VaccAbsent");
                                    throw new \Doctrine\DBAL\DBALException;
                                }
                                if(is_null($row['F']))
                                    $user->setVaccAbsent(NULL);
                                else
                                    $user->setVaccAbsent(trim($row['F']));
                                //check datatype of the filed.
                                if(is_double($row['G']) || is_null($row['G']))
                                    echo "";
                                else {
                                    $stmtt = $em->getRepository('AppPolioDbBundle:TempCatchupData')
                                        ->truncatTempCatchupData();
                                    $request->getSession()->getFlashBag()->add('datatype_exception', "Check data type of column RegSleep");
                                    throw new \Doctrine\DBAL\DBALException;
                                }
                                if(is_null($row['G']))
                                    $user->setRegSleep(NULL);
                                else
                                    $user->setRegSleep(trim($row['G']));
                                //check datatype of the filed.
                                if(is_double($row['H']) || is_null($row['H']))
                                    echo "";
                                else {
                                    $stmtt = $em->getRepository('AppPolioDbBundle:TempCatchupData')
                                        ->truncatTempCatchupData();
                                    $request->getSession()->getFlashBag()->add('datatype_exception', "Check data type of column VaccSleep");
                                    throw new \Doctrine\DBAL\DBALException;
                                }
                                if(is_null($row['H']))
                                    $user->setVaccSleep(NULL);
                                else
                                    $user->setVaccSleep(trim($row['H']));
                                //check datatype of the filed.
                                if(is_double($row['I']) || is_null($row['I']))
                                    echo "";
                                else {
                                    $stmtt = $em->getRepository('AppPolioDbBundle:TempCatchupData')
                                        ->truncatTempCatchupData();
                                    $request->getSession()->getFlashBag()->add('datatype_exception', "Check data type of column RegRegusal");
                                    throw new \Doctrine\DBAL\DBALException;
                                }
                                if(is_null($row['I']))
                                    $user->setRegRefusal(NULL);
                                else
                                    $user->setRegRefusal(trim($row['I']));
                                //check datatype of the filed.
                                if(is_double($row['J']) || is_null($row['J']))
                                    echo "";
                                else {
                                    $stmtt = $em->getRepository('AppPolioDbBundle:TempCatchupData')
                                        ->truncatTempCatchupData();
                                    $request->getSession()->getFlashBag()->add('datatype_exception', "Check data type of column VaccRegusal");
                                    throw new \Doctrine\DBAL\DBALException;
                                }
                                if(is_null($row['J']))
                                    $user->setVaccRefusal(NULL);
                                else
                                    $user->setVaccRefusal(trim($row['J']));
                                //check datatype of the filed.
                                if(is_double($row['K']) || is_null($row['K']))
                                    echo "";
                                else {
                                    $stmtt = $em->getRepository('AppPolioDbBundle:TempCatchupData')
                                        ->truncatTempCatchupData();
                                    $request->getSession()->getFlashBag()->add('datatype_exception', "Check data type of column NewMissed");
                                    throw new \Doctrine\DBAL\DBALException;
                                }
                                if(is_null($row['K']))
                                    $user->setNewMissed(NULL);
                                else
                                    $user->setNewMissed(trim($row['K']));
                                //check datatype of the filed.
                                if(is_double($row['L']) || is_null($row['L']))
                                    echo "";
                                else {
                                    $stmtt = $em->getRepository('AppPolioDbBundle:TempCatchupData')
                                        ->truncatTempCatchupData();
                                    $request->getSession()->getFlashBag()->add('datatype_exception', "Check data type of column NewVaccinated");
                                    throw new \Doctrine\DBAL\DBALException;
                                }
                                if(is_null($row['L']))
                                    $user->setNewVaccinated(NULL);
                                else
                                    $user->setNewVaccinated(trim($row['L']));
                                //check datatype of the filed.
                                if(is_double($row['M']) || is_null($row['M']))
                                    echo "";
                                else {
                                    $stmtt = $em->getRepository('AppPolioDbBundle:TempCatchupData')
                                        ->truncatTempCatchupData();
                                    $request->getSession()->getFlashBag()->add('datatype_exception', "Check data type of column CampaignId");
                                    throw new \Doctrine\DBAL\DBALException;
                                }
                                if(is_null($row['M']))
                                    $user->setCampaignId(NULL);
                                else
                                    $user->setCampaignId(trim($row['M']));
                                //... and so on
                                $em->persist($user);
                                $em->flush();
                            }
                        }//end of foreach
                        $request->getSession()->getFlashBag()->add('notice', "Add done!");
                        $syncbuttonbool = "";
                        $uploadbuttonbool = "disabled";
                    } catch (\Symfony\Component\Debug\Exception\ContextErrorException $e) {
                        $request->getSession()->getFlashBag()->add('exception', $e->getMessage());
                    }
                    catch (\Doctrine\DBAL\DBALException $e) {
                        //$request->getSession()->getFlashBag()->add('notice', $e->getMessage());
                    }
                }
            }//end of handling first form.
            if ($request->request->has('form2')) {
                $form2->handleRequest($request);
                try {
                    $em = $this->getDoctrine()->getManager();
                    $stmt = $em->getRepository('AppPolioDbBundle:TempCatchupData')
                        ->catchupSyncToMaster();
                    $stmtt = $em->getRepository('AppPolioDbBundle:TempCatchupData')
                        ->truncatTempCatchupData();
                    $request->getSession()->getFlashBag()->add('noticee', "Sync to Master done!");
                } catch (\Symfony\Component\Debug\Exception\ContextErrorException $e) {
                    $request->getSession()->getFlashBag()->add('noticee', $e->getMessage());
                }
                catch (\Doctrine\DBAL\DBALException $e) {
                    $request->getSession()->getFlashBag()->add('masterexception', "Please check you data on CompaignId and districtCode, upload your file again.");
                    $stmtt = $em->getRepository('AppPolioDbBundle:TempCatchupData')
                        ->truncatTempCatchupData();
                }
            }//end of second form.
        }
        return $this->render('html/upload.html.twig', array ('form' => $form->createView(), 'form2' => $form2->createView(), 'table' => $datasource,
            'syncbutt' => $syncbuttonbool, 'uploadbutt' => $uploadbuttonbool));
    }
}