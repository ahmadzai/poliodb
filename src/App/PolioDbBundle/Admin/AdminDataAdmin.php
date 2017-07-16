<?php
// src/App/PolioDbBundle/Admin/AdminDataAdmin.php

namespace App\PolioDbBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Doctrine\ORM\EntityRepository;
//use Symfony\Bundle\DoctrineBundle\Registry;
use App\PolioDbBundle\Admin\ProvinceListBuilder;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query;


class AdminDataAdmin extends AbstractAdmin
{
      protected $baseRoutePattern = 'adminadata';


      private $site_list_builder;

   public function setSiteListBuilder(ProvinceListBuilder $slb)
   {
       $this->site_list_builder = $slb;
   }


  //  public function createQuery($context = 'list')
  //  {
   //
  //      $qb = parent::createQuery($context);
  //     //  $qb = $this->getModelManager()
  //     //       ->getEntityManager('AppPolioDbBundle:AdminData');
  //     //       ->createQueryBuilder('a');
  //      // you can do anything with this that you can do with the doctrine
  //      // QueryBuilder
   //
  //     // $queryBuilder
  //      $qb->select(array('u'))
  //      ->from('AdminData', 'u')
  //     //  ->where('districtCode = :price')
  //     //  ->setParameter('price', '101');
  //      ->where($qb->expr()->eq('a.districtCode', '?101'));
  //      //$qb->setParameter('that', '101');
  //      return $qb;
  //  }

    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {


        $formMapper
            ->add('clusterName', 'text', array(
                'label' => 'Cluster Name'
            ))
            ->add('targetPopulation')

            // if no type is specified, SonataAdminBundle tries to guess it
            ->add('receivedVials')

            // ...
       ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
       $datagridMapper
        /**    ->add('clusterName', null, array(
            'operator_type' => 'hidden',
            'advanced_filter' => false
        ))
            ->add('targetPopulation', null, array(
            'operator_type' => 'hidden',
            'advanced_filter' => false
        ))*/
        ->add('campaign', null, array(), 'entity', array(
          'class'       => 'AppPolioDbBundle:Campaign',
          'choice_label' => 'campaignName', 'multiple' => true,
          'query_builder' => function (EntityRepository $er) {
            return $er->createQueryBuilder('u')
            ->groupBy('u.campaignName');
   },

          ))

        ->add('region', 'doctrine_orm_callback', array(
            'callback'   => array($this, 'callbackFilterRegion'),
            'field_type' => 'checkbox'
          ),
          'choice',
          array('choices' => $this -> getRegionList(), 'multiple' => true))

        // ->add('province', 'doctrine_orm_callback', array(
        //   'callback'   => array($this, 'callbackFilterProvince'),
        //   ),
        //   'entity', array(
        //    'class'       => 'AppPolioDbBundle:Province',
        //    'choice_label' => 'provinceName', 'multiple' => true,
        //    'query_builder' => function (EntityRepository $er) {
        //      return $er->createQueryBuilder('u')
        //      ->groupBy('u.provinceName');
        //    },
        //   ))

            ->add('district.districtCode', null, array(), 'entity', array(
             'class'       => 'AppPolioDbBundle:District',
             'choice_label' => 'districtName', 'multiple' => true,
             'query_builder' => function (EntityRepository $er) {
               return $er->createQueryBuilder('u')
               ->groupBy('u.districtName');
      },

             ))

          /**  ->add('cluster', null, array(), 'entity', array(
            'class'       => 'AppPolioDbBundle:Province',
            'choice_label' => 'provinceRegion',
            'query_builder' => function (EntityRepository $er) {
              return $er->createQueryBuilder('u')
              ->groupBy('u.provinceRegion');
     },

            )) */


       ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {

    //   $parameters = parent::getFilterParameters();
    //
    // $request = $this->getRequest();
    // //dump($request);
    // $dateParameter = $request->query->get('filter')['region'];
    // dump($dateParameter);
        $listMapper
            ->addIdentifier('clusterName')
            ->add('targetPopulation')
            ->add('receivedVials')
       ;
    }

    // Fields to be shown on show action
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
           ->add('clusterName')
           ->add('targetPopulation')

       ;
    }

    public function getProvinceList()
    {
        $age = array("Kabul"=>"1", "Kandahar"=>"2", "Laghman"=>"3", "beh"=>"6");
         return $age;

       ;
    }
    public function getRegionList()
    {
        $age = array("CR"=>"CR", "ER"=>"ER", "NER"=>"NER", "SER"=>"SER", "NR"=>"NR", "WR"=>"WR", "SR"=>"SR");
         return $age;
       ;
    }

    public function callbackFilterProvince ($queryBuilder, $alias, $field, $value)
{
    if(!is_array($value) or !array_key_exists('value', $value)
        or empty($value['value'])){

        return;

    }

    $queryBuilder
    ->leftJoin(sprintf('%s.districtCode', $alias), 'u')
    ->leftJoin('u.provinceCode', 'c')
    ->andWhere('c.provinceCode IN (:id)')
    ->setParameter('id', $value['value'])
    ;

    return true;
}

   public function callbackFilterRegion ($queryBuilder, $alias, $field, $value)
  {
    if(!is_array($value) or !array_key_exists('value', $value)
    or empty($value['value'])){

      return;

    }

    $queryBuilder
    ->leftJoin(sprintf('%s.districtCode', $alias), 'hh')
    ->leftJoin('hh.provinceCode', 'kk')
    ->Where('kk.provinceRegion IN (:id)')
    ->setParameter('id', $value['value'])
    ;

    return true;
  }

  public function callbackFilterCampaign ($queryBuilder, $alias, $field, $value)
  {
    if(!is_array($value) or !array_key_exists('value', $value)
    or empty($value['value'])){

      return;

    }

     $queryBuilder
     ->leftJoin(sprintf('%s.campaign', $alias), 'zz')
     ->Where('zz.campaignId IN (:id)')
     ->setParameter('id', $value['value'])
     ;
   return true;
  }
}
