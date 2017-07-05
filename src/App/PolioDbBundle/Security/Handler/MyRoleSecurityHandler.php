<?php
# AppBundle/Security/Handler/MyRoleSecurityHandler.php

namespace App\PolioDbBundle\Security\Handler;

use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Security\Handler\RoleSecurityHandler;

class MyRoleSecurityHandler extends RoleSecurityHandler
{
   /**
    * {@inheritDoc}
    */
   public function getBaseRole(AdminInterface $admin)
   {
        return 'ROLE_SONATA_ADMIN_%s';
   }
}
