<?php

namespace App\PolioDbBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * AdminData4
 *
 * @ORM\Table(name="admin_data4")
 * @ORM\Entity(readOnly=true, repositoryClass="App\PolioDbBundle\Entity\AdminData4Repository")
 */
class AdminData4
{

    /**
     * @var string
     *
     * @ORM\Column(name="Region", type="text", length=65535, nullable=true)
     */
    private $region;

    /**
     * @var string
     *
     * @ORM\Column(name="Province", type="text", length=65535, nullable=true)
     */
    private $province;

    /**
     * @var string
     *
     * @ORM\Column(name="District", type="text", length=65535, nullable=true)
     */
    private $district;

    /**
     * @var string
     *
     * @ORM\Column(name="ClusterName", type="text", length=65535, nullable=true)
     */
    private $clusterName;

    /**
     * @var string
     *
     * @ORM\Column(name="ClusterNo", type="text", length=65535, nullable=true)
     */
    private $clusterNo;

    /**
     * @var string
     *
     * @ORM\Column(name="SubDistrict", type="text", length=65535, nullable=true)
     */
    private $subDistrict;

    /**
     * @var integer
     *
     * @ORM\Column(name="LPD", type="integer", nullable=true)
     */
    private $lpd;

    /**
     * @var integer
     *
     * @ORM\Column(name="DCODE", type="integer", nullable=true)
     */
    private $dcode;

    /**
     * @var string
     *
     * @ORM\Column(name="C_Type", type="text", nullable=true)
     */
    private $cType;

    /**
     * @var integer
     *
     * @ORM\Column(name="Year", type="integer", nullable=true)
     */
    private $cYear;

    /**
     * @var string
     *
     * @ORM\Column(name="Month", type="text", nullable=true)
     */
    private $cMonth;

    /**
     * @var integer
     *
     * @ORM\Column(name="D4_Remaining_Absent", type="integer", nullable=true)
     */
    private $remainingAbsent;

    /**
     * @var integer
     *
     * @ORM\Column(name="D4_Remaining_Sleep", type="integer", nullable=true)
     */
    private $remainingSleep;

    /**
     * @var integer
     *
     * @ORM\Column(name="D4_Remaining_Refusal", type="integer", nullable=true)
     */
    private $remainingRefusal;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     */
    private $id;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }


    public function getRegion()
    {
        return $this->region;
    }

    /**
     * @return string
     */
    public function getProvince()
    {
        return $this->province;
    }

    /**
     * @return string
     */
    public function getDistrict()
    {
        return $this->district;
    }

    /**
     * @return string
     */
    public function getClusterName()
    {
        return $this->clusterName;
    }

    /**
     * @return string
     */
    public function getClusterNo()
    {
        return $this->clusterNo;
    }

    /**
     * @return string
     */
    public function getSubDistrict()
    {
        return $this->subDistrict;
    }

    /**
     * @return int
     */
    public function getLpd()
    {
        return $this->lpd;
    }

    /**
     * @return int
     */
    public function getDcode()
    {
        return $this->dcode;
    }

    /**
     * @return string
     */
    public function getCType()
    {
        return $this->cType;
    }

    /**
     * @return int
     */
    public function getCYear()
    {
        return $this->cYear;
    }

    /**
     * @return string
     */
    public function getCMonth()
    {
        return $this->cMonth;
    }

    /**
     * @return int
     */
    public function getRemainingAbsent()
    {
        return $this->remainingAbsent;
    }

    /**
     * @return int
     */
    public function getRemainingSleep()
    {
        return $this->remainingSleep;
    }

    /**
     * @return int
     */
    public function getRemainingRefusal()
    {
        return $this->remainingRefusal;
    }




}
