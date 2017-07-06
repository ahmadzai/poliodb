<?php
namespace App\PolioDbBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class UserAdmin extends AbstractAdmin
{

    protected $baseRoutePattern = 'user';
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('username', 'text')
        ->add('email', 'text')
        ->add('plainPassword', 'password');
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('username')
        ->add('email');
        //->add('firstname');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('username')
        ->add('email');
    }

    public function preUpdate($user)
    {
        $this->getUserManager()->updateCanonicalFields($user);
        $this->getUserManager()->updatePassword($user);
    }

    public function setUserManager(UserManagerInterface $userManager)
        {
            $this->userManager = $userManager;
        }

    public function getUserManager()
    {
            return $this->userManager;
    }
}
