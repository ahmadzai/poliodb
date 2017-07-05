<?php

namespace App\PolioDbBundle\Entity;

/**
 * TempCatchupData
 */
class TempCatchupData
{
    /**
     * @var string
     */
    private $subDistrictName;

    /**
     * @var integer
     */
    private $districtCode;

    /**
     * @var string
     */
    private $clusterName;

    /**
     * @var string
     */
    private $clusterNo;

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
     * @var integer
     */
    private $campaignId;

    /**
     * @var integer
     */
    private $id;


    /**
     * Set subDistrictName
     *
     * @param string $subDistrictName
     *
     * @return TempCatchupData
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
     * Set districtCode
     *
     * @param integer $districtCode
     *
     * @return TempCatchupData
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
     * Set clusterName
     *
     * @param string $clusterName
     *
     * @return TempCatchupData
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
     * @return TempCatchupData
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
     * Set regAbsent
     *
     * @param integer $regAbsent
     *
     * @return TempCatchupData
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
     * @return TempCatchupData
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
     * @return TempCatchupData
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
     * @return TempCatchupData
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
     * @return TempCatchupData
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
     * @return TempCatchupData
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
     * @return TempCatchupData
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
     * @return TempCatchupData
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
     * Set campaignId
     *
     * @param integer $campaignId
     *
     * @return TempCatchupData
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
}

