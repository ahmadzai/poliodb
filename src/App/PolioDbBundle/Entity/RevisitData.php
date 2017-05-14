<?php

namespace App\PolioDbBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RevisitData
 *
 * @ORM\Table(name="revisit_data", indexes={@ORM\Index(name="fk_dist_revisit_idx", columns={"district_code"})})
 * @ORM\Entity
 */
class RevisitData
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
     * @ORM\Column(name="new_vaccinated", type="integer", nullable=true)
     */
    private $newVaccinated;

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
     * @ORM\Column(name="campaign_id", type="integer", nullable=true)
     */
    private $campaignId;

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
     * Set clusterName
     *
     * @param string $clusterName
     *
     * @return RevisitData
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
     * @return RevisitData
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
     * @return RevisitData
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
     * @return RevisitData
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
     * @return RevisitData
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
     * @return RevisitData
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
     * @return RevisitData
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
     * @return RevisitData
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
     * @return RevisitData
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
     * @return RevisitData
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
     * @return RevisitData
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
     * @return RevisitData
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
     * @return RevisitData
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
     * @return RevisitData
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
     * Set newVaccinated
     *
     * @param integer $newVaccinated
     *
     * @return RevisitData
     */
    public function setNewVaccinated($newVaccinated)
    {
        $this->newVaccinated = $newVaccinated;

        return $this;
    }

    /**
     * Get newVaccinated
     *
     * @return integer
     */
    public function getNewVaccinated()
    {
        return $this->newVaccinated;
    }

    /**
     * Set newPolioCase
     *
     * @param integer $newPolioCase
     *
     * @return RevisitData
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
     * @return RevisitData
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
     * @return RevisitData
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
     * Set campaignId
     *
     * @param integer $campaignId
     *
     * @return RevisitData
     */
    public function setCampaignId($campaignId)
    {
        $this->campaignId = $campaignId;

        return $this;
    }

    /**
     * Get campaignId
     *
     * @return integer
     */
    public function getCampaignId()
    {
        return $this->campaignId;
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
     * @return RevisitData
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
}
