<?php
// src/App/PolioDbBundle/Admin/AdminDataAdmin.php

namespace App\PolioDbBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;

class AdminDataAdmin extends AbstractAdmin
{

    protected $baseRoutePattern = 'adminadata';
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
            ->add('clusterName')
            ->add('targetPopulation')
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
           ->add('targetPopulation  ')
       ;
    }
}
