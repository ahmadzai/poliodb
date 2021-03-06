<?php

namespace App\PolioDbBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AdminData
 *
 * @ORM\Table(name="admin_data", indexes={@ORM\Index(name="fk_dist_adm_idx", columns={"district_code"}), @ORM\Index(name="fk_camp_adm_idx", columns={"campaign_id"})})
 * @ORM\Entity(repositoryClass="App\PolioDbBundle\Entity\AdminDataRepository")
 */
class AdminData
{
    /**
     * @var string
     *
     * @ORM\Column(name="cluster_name", type="text", length=65535, nullable=true)
     */
    private $clusterName;

    /**
     * @var string
     *
     * @ORM\Column(name="cluster", type="text", length=65535, nullable=true)
     */
    private $cluster;

    /**
     * @param string $cluster
     */
    public function setCluster($cluster)
    {
        $this->cluster = $cluster;
    }

    /**
     * @return string
     */
    public function getCluster()
    {
        return $this->cluster;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="cluster_no", type="text", length=65535, nullable=true)
     */
    private $clusterNo;

    /**
     * @var string
     *
     * @ORM\Column(name="sub_district_name", type="text", length=65535, nullable=true)
     */
    private $subDistrictName;

    /**
     * @var integer
     *
     * @ORM\Column(name="target_population", type="integer", nullable=true)
     */
    private $targetPopulation;

    /**
     * @var integer
     *
     * @ORM\Column(name="received_vials", type="integer", nullable=true)
     */
    private $receivedVials;

    /**
     * @var integer
     *
     * @ORM\Column(name="used_vials", type="integer", nullable=true)
     */
    private $usedVials;

    /**
     * @var integer
     *
     * @ORM\Column(name="child_0_11", type="integer", nullable=true)
     */
    private $child011;

    /**
     * @var integer
     *
     * @ORM\Column(name="child_12_59", type="integer", nullable=true)
     */
    private $child1259;

    /**
     * @var integer
     *
     * @ORM\Column(name="reg_absent", type="integer", nullable=true)
     */
    private $regAbsent;

    /**
     * @var integer
     *
     * @ORM\Column(name="vacc_absent", type="integer", nullable=true)
     */
    private $vaccAbsent;

    /**
     * @var integer
     *
     * @ORM\Column(name="reg_sleep", type="integer", nullable=true)
     */
    private $regSleep;

    /**
     * @var integer
     *
     * @ORM\Column(name="vacc_sleep", type="integer", nullable=true)
     */
    private $vaccSleep;

    /**
     * @var integer
     *
     * @ORM\Column(name="reg_refusal", type="integer", nullable=true)
     */
    private $regRefusal;

    /**
     * @var integer
     *
     * @ORM\Column(name="vacc_refusal", type="integer", nullable=true)
     */
    private $vaccRefusal;

    /**
     * @var integer
     *
     * @ORM\Column(name="new_polio_case", type="integer", nullable=true)
     */
    private $newPolioCase;

    /**
     * @var integer
     *
     * @ORM\Column(name="vacc_day", type="integer", nullable=true)
     */
    private $vaccDay;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="entry_date", type="datetime", nullable=true)
     */
    private $entryDate = 'CURRENT_TIMESTAMP';

    /**
     * @var integer
     *
     * @ORM\Column(name="missed", type="integer", nullable=true)
     */
    private $missed;

    /**
     * @var integer
     *
     * @ORM\Column(name="sleep", type="integer", nullable=true)
     */
    private $sleep;

    /**
     * @var integer
     *
     * @ORM\Column(name="refusal", type="integer", nullable=true)
     */
    private $refusal;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \App\PolioDbBundle\Entity\District
     *
     * @ORM\ManyToOne(targetEntity="App\PolioDbBundle\Entity\District")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="district_code", referencedColumnName="district_code")
     * })
     */
    private $districtCode;

    /**
     * @var \App\PolioDbBundle\Entity\Campaign
     *
     * @ORM\ManyToOne(targetEntity="App\PolioDbBundle\Entity\Campaign")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="campaign_id", referencedColumnName="campaign_id")
     * })
     */
    private $campaign;



    /**
     * Set clusterName
     *
     * @param string $clusterName
     *
     * @return AdminData
     */
    public function setClusterName($clusterName)
    {
        $this->clusterName = $clusterName;

        return $this;
    }

    /**
     * Get clusterName
     *
     * @return string
     */
    public function getClusterName()
    {
        return $this->clusterName;
    }

    /**
     * Set clusterNo
     *
     * @param string $clusterNo
     *
     * @return AdminData
     */
    public function setClusterNo($clusterNo)
    {
        $this->clusterNo = $clusterNo;

        return $this;
    }

    /**
     * Get clusterNo
     *
     * @return string
     */
    public function getClusterNo()
    {
        return $this->clusterNo;
    }

    /**
     * Set subDistrictName
     *
     * @param string $subDistrictName
     *
     * @return AdminData
     */
    public function setSubDistrictName($subDistrictName)
    {
        $this->subDistrictName = $subDistrictName;

        return $this;
    }

    /**
     * Get subDistrictName
     *
     * @return string
     */
    public function getSubDistrictName()
    {
        return $this->subDistrictName;
    }

    /**
     * Set targetPopulation
     *
     * @param integer $targetPopulation
     *
     * @return AdminData
     */
    public function setTargetPopulation($targetPopulation)
    {
        $this->targetPopulation = $targetPopulation;

        return $this;
    }

    /**
     * Get targetPopulation
     *
     * @return integer
     */
    public function getTargetPopulation()
    {
        return $this->targetPopulation;
    }

    /**
     * Set receivedVials
     *
     * @param integer $receivedVials
     *
     * @return AdminData
     */
    public function setReceivedVials($receivedVials)
    {
        $this->receivedVials = $receivedVials;

        return $this;
    }

    /**
     * Get receivedVials
     *
     * @return integer
     */
    public function getReceivedVials()
    {
        return $this->receivedVials;
    }

    /**
     * Set usedVials
     *
     * @param integer $usedVials
     *
     * @return AdminData
     */
    public function setUsedVials($usedVials)
    {
        $this->usedVials = $usedVials;

        return $this;
    }

    /**
     * Get usedVials
     *
     * @return integer
     */
    public function getUsedVials()
    {
        return $this->usedVials;
    }

    /**
     * Set child011
     *
     * @param integer $child011
     *
     * @return AdminData
     */
    public function setChild011($child011)
    {
        $this->child011 = $child011;

        return $this;
    }

    /**
     * Get child011
     *
     * @return integer
     */
    public function getChild011()
    {
        return $this->child011;
    }

    /**
     * Set child1259
     *
     * @param integer $child1259
     *
     * @return AdminData
     */
    public function setChild1259($child1259)
    {
        $this->child1259 = $child1259;

        return $this;
    }

    /**
     * Get child1259
     *
     * @return integer
     */
    public function getChild1259()
    {
        return $this->child1259;
    }

    /**
     * Set regAbsent
     *
     * @param integer $regAbsent
     *
     * @return AdminData
     */
    public function setRegAbsent($regAbsent)
    {
        $this->regAbsent = $regAbsent;

        return $this;
    }

    /**
     * Get regAbsent
     *
     * @return integer
     */
    public function getRegAbsent()
    {
        return $this->regAbsent;
    }

    /**
     * Set vaccAbsent
     *
     * @param integer $vaccAbsent
     *
     * @return AdminData
     */
    public function setVaccAbsent($vaccAbsent)
    {
        $this->vaccAbsent = $vaccAbsent;

        return $this;
    }

    /**
     * Get vaccAbsent
     *
     * @return integer
     */
    public function getVaccAbsent()
    {
        return $this->vaccAbsent;
    }

    /**
     * Set regSleep
     *
     * @param integer $regSleep
     *
     * @return AdminData
     */
    public function setRegSleep($regSleep)
    {
        $this->regSleep = $regSleep;

        return $this;
    }

    /**
     * Get regSleep
     *
     * @return integer
     */
    public function getRegSleep()
    {
        return $this->regSleep;
    }

    /**
     * Set vaccSleep
     *
     * @param integer $vaccSleep
     *
     * @return AdminData
     */
    public function setVaccSleep($vaccSleep)
    {
        $this->vaccSleep = $vaccSleep;

        return $this;
    }

    /**
     * Get vaccSleep
     *
     * @return integer
     */
    public function getVaccSleep()
    {
        return $this->vaccSleep;
    }

    /**
     * Set regRefusal
     *
     * @param integer $regRefusal
     *
     * @return AdminData
     */
    public function setRegRefusal($regRefusal)
    {
        $this->regRefusal = $regRefusal;

        return $this;
    }

    /**
     * Get regRefusal
     *
     * @return integer
     */
    public function getRegRefusal()
    {
        return $this->regRefusal;
    }

    /**
     * Set vaccRefusal
     *
     * @param integer $vaccRefusal
     *
     * @return AdminData
     */
    public function setVaccRefusal($vaccRefusal)
    {
        $this->vaccRefusal = $vaccRefusal;

        return $this;
    }

    /**
     * Get vaccRefusal
     *
     * @return integer
     */
    public function getVaccRefusal()
    {
        return $this->vaccRefusal;
    }

    /**
     * Set newPolioCase
     *
     * @param integer $newPolioCase
     *
     * @return AdminData
     */
    public function setNewPolioCase($newPolioCase)
    {
        $this->newPolioCase = $newPolioCase;

        return $this;
    }

    /**
     * Get newPolioCase
     *
     * @return integer
     */
    public function getNewPolioCase()
    {
        return $this->newPolioCase;
    }

    /**
     * Set vaccDay
     *
     * @param integer $vaccDay
     *
     * @return AdminData
     */
    public function setVaccDay($vaccDay)
    {
        $this->vaccDay = $vaccDay;

        return $this;
    }

    /**
     * Get vaccDay
     *
     * @return integer
     */
    public function getVaccDay()
    {
        return $this->vaccDay;
    }

    /**
     * Set entryDate
     *
     * @param \DateTime $entryDate
     *
     * @return AdminData
     */
    public function setEntryDate($entryDate)
    {
        $this->entryDate = $entryDate;

        return $this;
    }

    /**
     * Get entryDate
     *
     * @return \DateTime
     */
    public function getEntryDate()
    {
        return $this->entryDate;
    }

    /**
     * Set missed
     *
     * @param integer $missed
     *
     * @return AdminData
     */
    public function setMissed($missed)
    {
        $this->missed = $missed;

        return $this;
    }

    /**
     * Get missed
     *
     * @return integer
     */
    public function getMissed()
    {
        return $this->missed;
    }

    /**
     * Set sleep
     *
     * @param integer $sleep
     *
     * @return AdminData
     */
    public function setSleep($sleep)
    {
        $this->sleep = $sleep;

        return $this;
    }

    /**
     * Get sleep
     *
     * @return integer
     */
    public function getSleep()
    {
        return $this->sleep;
    }

    /**
     * Set refusal
     *
     * @param integer $refusal
     *
     * @return AdminData
     */
    public function setRefusal($refusal)
    {
        $this->refusal = $refusal;

        return $this;
    }

    /**
     * Get refusal
     *
     * @return integer
     */
    public function getRefusal()
    {
        return $this->refusal;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set districtCode
     *
     * @param \App\PolioDbBundle\Entity\District $districtCode
     *
     * @return AdminData
     */
    public function setDistrictCode(\App\PolioDbBundle\Entity\District $districtCode = null)
    {
        $this->districtCode = $districtCode;

        return $this;
    }

    /**
     * Get districtCode
     *
     * @return \App\PolioDbBundle\Entity\District
     */
    public function getDistrictCode()
    {
        return $this->districtCode;
    }

    /**
     * Set campaign
     *
     * @param \App\PolioDbBundle\Entity\Campaign $campaign
     *
     * @return AdminData
     */
    public function setCampaign(\App\PolioDbBundle\Entity\Campaign $campaign = null)
    {
        $this->campaign = $campaign;

        return $this;
    }

    /**
     * Get campaign
     *
     * @return \App\PolioDbBundle\Entity\Campaign
     */
    public function getCampaign()
    {
        return $this->campaign;
    }
}
