<?php

namespace App\PolioDbBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CatchupData
 *
 * @ORM\Table(name="catchup_data", indexes={@ORM\Index(name="fk_dist_catchup_idx", columns={"district_code"}), @ORM\Index(name="fk_camp_catchup_idx", columns={"campaign_id"})})
 * @ORM\Entity(repositoryClass="App\PolioDbBundle\Entity\CatchupDataRepository")
 */
class CatchupData
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
     * @ORM\Column(name="new_missed", type="integer", nullable=true)
     */
    private $newMissed;

    /**
     * @var integer
     *
     * @ORM\Column(name="new_vaccinated", type="integer", nullable=true)
     */
    private $newVaccinated;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="entry_date", type="datetime", nullable=true)
     */
    private $entryDate = 'CURRENT_TIMESTAMP';

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
     * @ORM\Column(name="new_remaining", type="integer", nullable=true)
     */
    private $newRemaining;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;


    /**
     * Set clusterName
     *
     * @param string $clusterName
     *
     * @return CatchupData
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
     * @return CatchupData
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
     * @return CatchupData
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
     * Set regAbsent
     *
     * @param integer $regAbsent
     *
     * @return CatchupData
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
     * @return CatchupData
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
     * @return CatchupData
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
     * @return CatchupData
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
     * @return CatchupData
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
     * @return CatchupData
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
     * Set newMissed
     *
     * @param integer $newMissed
     *
     * @return CatchupData
     */
    public function setNewMissed($newMissed)
    {
        $this->newMissed = $newMissed;

        return $this;
    }

    /**
     * Get newMissed
     *
     * @return integer
     */
    public function getNewMissed()
    {
        return $this->newMissed;
    }

    /**
     * Set newVaccinated
     *
     * @param integer $newVaccinated
     *
     * @return CatchupData
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
     * Set entryDate
     *
     * @param \DateTime $entryDate
     *
     * @return CatchupData
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
     * Set districtCode
     *
     * @param integer $districtCode
     *
     * @return CatchupData
     */
    public function setDistrictCode($districtCode)
    {
        $this->districtCode = $districtCode;

        return $this;
    }

    /**
     * Get districtCode
     *
     * @return integer
     */
    public function getDistrictCode()
    {
        return $this->districtCode;
    }

    /**
     * Set campaignId
     *
     * @param integer $campaignId
     *
     * @return CatchupData
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
     * Set missed
     *
     * @param integer $missed
     *
     * @return CatchupData
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
     * @return CatchupData
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
     * @return CatchupData
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
     * Set newRemaining
     *
     * @param integer $newRemaining
     *
     * @return CatchupData
     */
    public function setNewRemaining($newRemaining)
    {
        $this->newRemaining = $newRemaining;

        return $this;
    }

    /**
     * Get newRemaining
     *
     * @return integer
     */
    public function getNewRemaining()
    {
        return $this->newRemaining;
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
     * Set campaign
     *
     * @param \App\PolioDbBundle\Entity\Campaign $campaign
     *
     * @return CatchupData
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
