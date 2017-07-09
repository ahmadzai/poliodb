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

  protected $baseRoutePattern = 'user';
    /**
        * {@inheritdoc}
        */
    protected function configureFormFields(FormMapper $formMapper)
    {
        parent::configureFormFields($formMapper);

        $formMapper
        ->tab('User')

        ->with('General')
                    ->add('username', TextType::class, array('label'=>'User Name'))
                    ->add('email', null, array('label'=>'Valid Email'))
                    ->add('plainPassword', TextType::class, array('label'=>'Password',
                        'required' => (!$this->getSubject() || is_null($this->getSubject()->getId())),
                    ))
                    ->add('firstname', TextType::class, array('required' => false, 'label'=>'First Name'))
                    ->add('lastname', TextType::class, array('required' => false, 'label'=>'Last Name'))
                    ->add('phone', TextType::class, array('required' => false, 'label'=>'Mobile No'))
                ->end()

            ->with('Profile')
              ->add('title', TextType::class, array('required' => false, 'label' => 'Title'))
              ->add('joblevel',  ChoiceType::class, array('choices' => array('National' => 'National', 'Region' => 'Region', 'Province' => 'Province')), array('required' => false, 'label' => 'Job Level'))
              ->add('region', TextType::class, array('required' => false, 'label' => 'Region'))
              ->add('province', TextType::class, array('required' => false, 'label' => 'Province'))
              ->add('gender',  ChoiceType::class, array('choices' => array('Male' => 'Male', 'Female' => 'Female')), array('required' => false, 'label' => 'Gender'))
                // ...
            ->end()
        ->end()
        ;

        $formMapper->removeGroup('Social', 'User')
                    ->remove('biography')
                    ->remove('locale')
                    ->remove('timezone')
                    ->remove('biography')
                    //->remove('gender')
                    ->removeGroup('Groups', 'Security')
                    ->removeGroup('Keys', 'Security')
                    ;
    }
}
