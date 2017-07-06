<?php

namespace App\PolioDbBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * AdminData4
 *
 * @ORM\Table(name="district_agg")
 * @ORM\Entity(readOnly=true, repositoryClass="App\PolioDbBundle\Entity\DistrictAggRepository")
 */
class DistrictAgg
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
     * @var integer
     *
     * @ORM\Column(name="province_code", type="integer", nullable=true)
     */
    private $provinceCode;

    /**
     * @return int
     */
    public function getProvinceCode()
    {
        return $this->provinceCode;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="District", type="text", length=65535, nullable=true)
     */
    private $district;

    /**
     * @var string
     *
     * @ORM\Column(name="CampaignDate", type="text", length=65535, nullable=true)
     */
    private $campaignDate;

    /**
     * @var integer
     *
     * @ORM\Column(name="LPD_Status", type="integer", nullable=true)
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
     * @ORM\Column(name="campaign_id", type="integer", nullable=true)
     */
    private $campaignId;

    /**
     * @return int
     */
    public function getCampaignId()
    {
        return $this->campaignId;
    }

    /**
     * @var integer
     *
     * @ORM\Column(name="Remaining_Absent", type="integer", nullable=true)
     */
    private $remainingAbsent;

    /**
     * @var integer
     *
     * @ORM\Column(name="Received_Vials", type="integer", nullable=true)
     */
    private $receivedVials;

    /**
     * @var integer
     *
     * @ORM\Column(name="Used_Vials", type="integer", nullable=true)
     */
    private $usedVials;

    /**
     * @var integer
     *
     * @ORM\Column(name="childs_0To11", type="integer", nullable=true)
     */
    private $child0To11;

    /**
     * @var integer
     *
     * @ORM\Column(name="childs_12To59", type="integer", nullable=true)
     */
    private $child12To59;

    /**
     * @var integer
     *
     * @ORM\Column(name="Reg_Absent", type="integer", nullable=true)
     */
    private $regAbsent;

    /**
     * @var integer
     *
     * @ORM\Column(name="Vacc_Absent", type="integer", nullable=true)
     */
    private $vaccAbsent;

    /**
     * @var integer
     *
     * @ORM\Column(name="Reg_Sleeps_NewBorn", type="integer", nullable=true)
     */
    private $regSleep;

    /**
     * @var integer
     *
     * @ORM\Column(name="Vacc_Sleeps_NewBorn", type="integer", nullable=true)
     */
    private $vaccSleep;

    /**
     * @var integer
     *
     * @ORM\Column(name="Remaining_Sleeps_NewBorn", type="integer", nullable=true)
     */
    private $remainingSleep;

    /**
     * @var integer
     *
     * @ORM\Column(name="Reg_refusals", type="integer", nullable=true)
     */
    private $regRefusal;

    /**
     * @return string
     */
    public function getCampaignDate()
    {
        return $this->campaignDate;
    }

    /**
     * @var integer
     *
     * @ORM\Column(name="Vacc_Refusals", type="integer", nullable=true)
     */
    private $vaccRefusal;

    /**
     * @var integer
     *
     * @ORM\Column(name="Remaining_Refusals", type="integer", nullable=true)
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
     * @return int
     */
    public function getReceivedVials()
    {
        return $this->receivedVials;
    }

    /**
     * @return int
     */
    public function getUsedVials()
    {
        return $this->usedVials;
    }

    /**
     * @return int
     */
    public function getChild0To11()
    {
        return $this->child0To11;
    }

    /**
     * @return int
     */
    public function getChild12To59()
    {
        return $this->child12To59;
    }

    /**
     * @return int
     */
    public function getRegAbsent()
    {
        return $this->regAbsent;
    }

    /**
     * @return int
     */
    public function getVaccAbsent()
    {
        return $this->vaccAbsent;
    }

    /**
     * @return int
     */
    public function getRegSleep()
    {
        return $this->regSleep;
    }

    /**
     * @return int
     */
    public function getVaccSleep()
    {
        return $this->vaccSleep;
    }

    /**
     * @return int
     */
    public function getRegRefusal()
    {
        return $this->regRefusal;
    }

    /**
     * @return int
     */
    public function getVaccRefusal()
    {
        return $this->vaccRefusal;
    }





    /**
     * Set region
     *
     * @param string $region
     *
     * @return DistrictAgg
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
     * @return DistrictAgg
     */
    public function setProvince($province)
    {
        $this->province = $province;

        return $this;
    }

    /**
     * Set provinceCode
     *
     * @param integer $provinceCode
     *
     * @return DistrictAgg
     */
    public function setProvinceCode($provinceCode)
    {
        $this->provinceCode = $provinceCode;

        return $this;
    }

    /**
     * Set district
     *
     * @param string $district
     *
     * @return DistrictAgg
     */
    public function setDistrict($district)
    {
        $this->district = $district;

        return $this;
    }

    /**
     * Set campaignDate
     *
     * @param string $campaignDate
     *
     * @return DistrictAgg
     */
    public function setCampaignDate($campaignDate)
    {
        $this->campaignDate = $campaignDate;

        return $this;
    }

    /**
     * Set lpd
     *
     * @param integer $lpd
     *
     * @return DistrictAgg
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
     * @return DistrictAgg
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
     * @return DistrictAgg
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
     * @return DistrictAgg
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
     * @return DistrictAgg
     */
    public function setCMonth($cMonth)
    {
        $this->cMonth = $cMonth;

        return $this;
    }

    /**
     * Set campaignId
     *
     * @param integer $campaignId
     *
     * @return DistrictAgg
     */
    public function setCampaignId($campaignId)
    {
        $this->campaignId = $campaignId;

        return $this;
    }

    /**
     * Set remainingAbsent
     *
     * @param integer $remainingAbsent
     *
     * @return DistrictAgg
     */
    public function setRemainingAbsent($remainingAbsent)
    {
        $this->remainingAbsent = $remainingAbsent;

        return $this;
    }

    /**
     * Set receivedVials
     *
     * @param integer $receivedVials
     *
     * @return DistrictAgg
     */
    public function setReceivedVials($receivedVials)
    {
        $this->receivedVials = $receivedVials;

        return $this;
    }

    /**
     * Set usedVials
     *
     * @param integer $usedVials
     *
     * @return DistrictAgg
     */
    public function setUsedVials($usedVials)
    {
        $this->usedVials = $usedVials;

        return $this;
    }

    /**
     * Set child0To11
     *
     * @param integer $child0To11
     *
     * @return DistrictAgg
     */
    public function setChild0To11($child0To11)
    {
        $this->child0To11 = $child0To11;

        return $this;
    }

    /**
     * Set child12To59
     *
     * @param integer $child12To59
     *
     * @return DistrictAgg
     */
    public function setChild12To59($child12To59)
    {
        $this->child12To59 = $child12To59;

        return $this;
    }

    /**
     * Set regAbsent
     *
     * @param integer $regAbsent
     *
     * @return DistrictAgg
     */
    public function setRegAbsent($regAbsent)
    {
        $this->regAbsent = $regAbsent;

        return $this;
    }

    /**
     * Set vaccAbsent
     *
     * @param integer $vaccAbsent
     *
     * @return DistrictAgg
     */
    public function setVaccAbsent($vaccAbsent)
    {
        $this->vaccAbsent = $vaccAbsent;

        return $this;
    }

    /**
     * Set regSleep
     *
     * @param integer $regSleep
     *
     * @return DistrictAgg
     */
    public function setRegSleep($regSleep)
    {
        $this->regSleep = $regSleep;

        return $this;
    }

    /**
     * Set vaccSleep
     *
     * @param integer $vaccSleep
     *
     * @return DistrictAgg
     */
    public function setVaccSleep($vaccSleep)
    {
        $this->vaccSleep = $vaccSleep;

        return $this;
    }

    /**
     * Set remainingSleep
     *
     * @param integer $remainingSleep
     *
     * @return DistrictAgg
     */
    public function setRemainingSleep($remainingSleep)
    {
        $this->remainingSleep = $remainingSleep;

        return $this;
    }

    /**
     * Set regRefusal
     *
     * @param integer $regRefusal
     *
     * @return DistrictAgg
     */
    public function setRegRefusal($regRefusal)
    {
        $this->regRefusal = $regRefusal;

        return $this;
    }

    /**
     * Set vaccRefusal
     *
     * @param integer $vaccRefusal
     *
     * @return DistrictAgg
     */
    public function setVaccRefusal($vaccRefusal)
    {
        $this->vaccRefusal = $vaccRefusal;

        return $this;
    }

    /**
     * Set remainingRefusal
     *
     * @param integer $remainingRefusal
     *
     * @return DistrictAgg
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
     * @return DistrictAgg
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
