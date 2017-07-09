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


class AdminDataAdmin extends AbstractAdmin
{
      protected $baseRoutePattern = 'adminadata';


      private $site_list_builder;

   public function setSiteListBuilder(ProvinceListBuilder $slb)
   {
       $this->site_list_builder = $slb;
   }


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
           ->add('districtCode', null, array(), 'entity', array(
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
            ->add('province', 'doctrine_orm_callback', array(
            'callback'   => array($this, 'callbackFilterCompany'),
            ),
            'choice',
            array('choices' => $this -> getProvinceList(), 'multiple' => true))


        ->add('region', 'doctrine_orm_callback', array(
          'callback'   => array($this, 'callbackFilterCompanyy'),
          'field_type' => 'checkbox'
        ),
        'choice',
        array('choices' => $this -> getRegionList(), 'multiple' => true))
       ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
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

    public function callbackFilterCompany ($queryBuilder, $alias, $field, $value)
{
    if(!is_array($value) or !array_key_exists('value', $value)
        or empty($value['value'])){

        return;

    }

    $queryBuilder
    ->leftJoin(sprintf('%s.districtCode', $alias), 'u')
    ->leftJoin('u.provinceCode', 'c')
    ->andWhere('u.provinceCode IN (:id)')
    ->setParameter('id', $value['value'])
    ;

    return true;
}

   public function callbackFilterCompanyy ($queryBuilder, $alias, $field, $value)
  {
    if(!is_array($value) or !array_key_exists('value', $value)
    or empty($value['value'])){

      return;

    }

    $queryBuilder
    ->leftJoin(sprintf('%s.districtCode', $alias), 'uu')
    ->leftJoin('uu.provinceCode', 'cc')
    ->Where('cc.provinceRegion IN (:id)')
    ->setParameter('id', $value['value'])
    ;

    return true;
  }

}
