<?php
namespace App\PolioDbBundle\Admin;

use Sonata\UserBundle\Admin\Model\UserAdmin as SonataUserAdmin;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class UserAdminNew extends SonataUserAdmin
{
    /**
        * {@inheritdoc}
        */
    protected function configureFormFields(FormMapper $formMapper)
    {
        parent::configureFormFields($formMapper);

        $formMapper
            ->with('Profile')
            ->add('title', TextType::class, array('required' => false, 'label' => 'Title'))
            ->add('joblevel',  ChoiceType::class, array('choices' => array('National' => 'National', 'Region' => 'Region', 'Province' => 'Province')), array('required' => false, 'label' => 'Job Level'))
            ->add('region', TextType::class, array('required' => false, 'label' => 'Region'))
            ->add('province', TextType::class, array('required' => false, 'label' => 'Province'))
                // ...
            ->end()
        ;
    }
}
