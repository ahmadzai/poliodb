<?php

namespace App\PolioDbBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\EntityManager;
use Sonata\UserBundle\Entity\BaseUser as BaseUser;

/**
 * @ORM\Entity
 * @ORM\Table(name="users",indexes={@ORM\Index(name="username_idx", columns={"id"})})
 */

class Users extends BaseUser {

    public function __construct()
    {
        parent::__construct();
        // your code here
    }

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;
}
