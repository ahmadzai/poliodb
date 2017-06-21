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





    /**
     * Set region
     *
     * @param string $region
     *
     * @return AdminData4
     */
    public function setRegion($region)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * Set province
     *
     * @param string $province
     *
     * @return AdminData4
     */
    public function setProvince($province)
    {
        $this->province = $province;

        return $this;
    }

    /**
     * Set district
     *
     * @param string $district
     *
     * @return AdminData4
     */
    public function setDistrict($district)
    {
        $this->district = $district;

        return $this;
    }

    /**
     * Set clusterName
     *
     * @param string $clusterName
     *
     * @return AdminData4
     */
    public function setClusterName($clusterName)
    {
        $this->clusterName = $clusterName;

        return $this;
    }

    /**
     * Set clusterNo
     *
     * @param string $clusterNo
     *
     * @return AdminData4
     */
    public function setClusterNo($clusterNo)
    {
        $this->clusterNo = $clusterNo;

        return $this;
    }

    /**
     * Set subDistrict
     *
     * @param string $subDistrict
     *
     * @return AdminData4
     */
    public function setSubDistrict($subDistrict)
    {
        $this->subDistrict = $subDistrict;

        return $this;
    }

    /**
     * Set lpd
     *
     * @param integer $lpd
     *
     * @return AdminData4
     */
    public function setLpd($lpd)
    {
        $this->lpd = $lpd;

        return $this;
    }

    /**
     * Set dcode
     *
     * @param integer $dcode
     *
     * @return AdminData4
     */
    public function setDcode($dcode)
    {
        $this->dcode = $dcode;

        return $this;
    }

    /**
     * Set cType
     *
     * @param string $cType
     *
     * @return AdminData4
     */
    public function setCType($cType)
    {
        $this->cType = $cType;

        return $this;
    }

    /**
     * Set cYear
     *
     * @param integer $cYear
     *
     * @return AdminData4
     */
    public function setCYear($cYear)
    {
        $this->cYear = $cYear;

        return $this;
    }

    /**
     * Set cMonth
     *
     * @param string $cMonth
     *
     * @return AdminData4
     */
    public function setCMonth($cMonth)
    {
        $this->cMonth = $cMonth;

        return $this;
    }

    /**
     * Set remainingAbsent
     *
     * @param integer $remainingAbsent
     *
     * @return AdminData4
     */
    public function setRemainingAbsent($remainingAbsent)
    {
        $this->remainingAbsent = $remainingAbsent;

        return $this;
    }

    /**
     * Set remainingSleep
     *
     * @param integer $remainingSleep
     *
     * @return AdminData4
     */
    public function setRemainingSleep($remainingSleep)
    {
        $this->remainingSleep = $remainingSleep;

        return $this;
    }

    /**
     * Set remainingRefusal
     *
     * @param integer $remainingRefusal
     *
     * @return AdminData4
     */
    public function setRemainingRefusal($remainingRefusal)
    {
        $this->remainingRefusal = $remainingRefusal;

        return $this;
    }

    /**
     * Set id
     *
     * @param integer $id
     *
     * @return AdminData4
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
