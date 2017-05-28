<?php

namespace App\PolioDbBundle\Entity;

/**
 * CatchupData
 */
class CatchupData
{
    /**
     * @var string
     */
    private $clusterName;

    /**
     * @var string
     */
    private $clusterNo;

    /**
     * @var string
     */
    private $subDistrictName;

    /**
     * @var integer
     */
    private $regAbsent;

    /**
     * @var integer
     */
    private $vaccAbsent;

    /**
     * @var integer
     */
    private $regSleep;

    /**
     * @var integer
     */
    private $vaccSleep;

    /**
     * @var integer
     */
    private $regRefusal;

    /**
     * @var integer
     */
    private $vaccRefusal;

    /**
     * @var integer
     */
    private $newMissed;

    /**
     * @var integer
     */
    private $newVaccinated;

    /**
     * @var \DateTime
     */
    private $entryDate = 'CURRENT_TIMESTAMP';

    /**
     * @var integer
     */
    private $districtCode;

    /**
     * @var integer
     */
    private $campaignId;

    /**
     * @var integer
     */
    private $missed;

    /**
     * @var integer
     */
    private $sleep;

    /**
     * @var integer
     */
    private $refusal;

    /**
     * @var integer
     */
    private $newRemaining;

    /**
     * @var integer
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
}

