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


class DashboardController extends Controller
{

    /**
     * @Route("/dashboard/admin_data", name="dashboard_admin_data")
     */
    public function DashboardAdminDataAction()
    {
        return $this->render("pages/home.html.twig");
    }

    /**
     * @Route("/dashboard/icm_data", name="dashboard_icm_data")
     */
    public function DashboardIcmDataAction()
    {
        return $this->render("pages/home.html.twig");
    }

    /**
     * @Route("/dashboard/catchup_data", name="dashboard_catchup_data")
     */
    public function DashboardCatchupDataAction()
    {
        return $this->render("pages/home.html.twig");
    }


}
