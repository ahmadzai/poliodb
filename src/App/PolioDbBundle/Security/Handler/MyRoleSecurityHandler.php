<?php
# AppBundle/Security/Handler/MyRoleSecurityHandler.php

namespace App\PolioDbBundle\Security\Handler;

use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Security\Handler\RoleSecurityHandler;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\SecurityContextInterface;

class MyRoleSecurityHandler extends RoleSecurityHandler
{

  public function __construct()
  {
    //parent::__construct();
  }
   /**
    * {@inheritDoc}
    */
   public function getBaseRole(AdminInterface $admin)
   {
     return 'ROLE_SONATA_ADMIN_%s';
   }

   public function isGranted(AdminInterface $admin, $attributes, $object = null)
    {
    }
}
