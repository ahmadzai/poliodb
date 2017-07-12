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

    /**
     * @ORM\Column(type="string")
     */
    protected $joblevel;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $region;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $province;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $title;

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getJobLevel() {
        return $this->joblevel;
    }

    public function setJobLevel($joblevel) {
        $this->joblevel = $joblevel;
    }

    public function getRegion() {
        return $this->region;
    }

    public function setRegion($region) {
        $this->region = $region;
    }

    public function getProvince() {
        return $this->province;
    }

    public function setProvince($province) {
        $this->province = $province;
    }
}
