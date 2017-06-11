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


class DataEntryController extends Controller
{

    /**
     * @Route("/data_entry/admin_data", name="entry_admin_data")
     */
    public function DashboardAdminDataAction()
    {
        return $this->render("pages/home.html.twig");
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

}
