<?php

namespace Sonata\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BaseUser
 *
 * @ORM\Table(name="BaseUser")
 * @ORM\MappedSuperclass
 * @ORM\HasLifecycleCallbacks
 */
class BaseUser
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=64, nullable=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="joblevel", type="string", length=64, nullable=true)
     */
    private $joblevel;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=64, nullable=true)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=64, nullable=true)
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="region", type="string", length=64, nullable=true)
     */
    private $region;

    /**
     * @var string
     *
     * @ORM\Column(name="province", type="string", length=64, nullable=true)
     */
    private $province;

    /**
     * @var string
     *
     * @ORM\Column(name="gender", type="string", length=1, nullable=true)
     */
    private $gender;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=64, nullable=true)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="token", type="string", length=255, nullable=true)
     */
    private $token;

    /**
     * @var string
     *
     * @ORM\Column(name="two_step_code", type="string", length=255, nullable=true)
     */
    private $twoStepVerificationCode;


    /**
     * @ORM\PrePersist
     */
    public function prePersist()
    {
        // Add your code here
    }

    /**
     * @ORM\PreUpdate
     */
    public function preUpdate()
    {
        // Add your code here
    }
}

