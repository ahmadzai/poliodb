<?php

namespace App\PolioDbBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="temp_admin_data")
 */
class TempAdminData
{
  /**
   * @ORM\Column(type="integer")
   */
    private $districtCode;

    /**
     * @ORM\Column(type="string")
     */
    private $subDistName;

    /**
     * @ORM\Column(type="string")
     */
    private $clusterName;

    /**
     * @ORM\Column(type="string")
     */
    private $clusterNo;

    /**
     * @ORM\Column(type="string")
     */
    private $cluster;

    /**
     * @ORM\Column(type="string")
     */
    private $targetPop;

    /**
     * @ORM\Column(type="integer")
     */
    private $givenVials;

    /**
     * @ORM\Column(type="integer")
     */
    private $usedVials;

    /**
     * @ORM\Column(type="integer")
     */
    private $child011;

    /**
     * @ORM\Column(type="integer")
     */
    private $child1259;

    /**
     * @ORM\Column(type="integer")
     */
    private $regAbsent;

    /**
     * @ORM\Column(type="integer")
     */
    private $vaccAbsent;

    /**
     * @ORM\Column(type="integer")
     */
    private $regSleep;

    /**
     * @ORM\Column(type="integer")
     */
    private $vaccSleep;

    /**
     * @ORM\Column(type="integer")
     */
    private $regRefusal;

    /**
     * @ORM\Column(type="integer")
     */
    private $vaccRefusal;

    /**
     * @ORM\Column(type="integer")
     */
    private $newPolioCase;

    /**
     * @ORM\Column(type="integer")
     */
    private $vaccDay;

    /**
     * @ORM\Column(type="integer")
     */
    private $campaignId;

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    private $file;

    public function getFile()
    {
      return $this->file;
    }

    public function setFile($file)
    {
       $this->file = $file;

       return $this;
     }


    /**
     * Set districtCode
     *
     * @param integer $districtCode
     *
     * @return TempAdminData
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
     * Set subDistName
     *
     * @param string $subDistName
     *
     * @return TempAdminData
     */
    public function setSubDistName($subDistName)
    {
        $this->subDistName = $subDistName;

        return $this;
    }

    /**
     * Get subDistName
     *
     * @return string
     */
    public function getSubDistName()
    {
        return $this->subDistName;
    }

    /**
     * Set clusterName
     *
     * @param string $clusterName
     *
     * @return TempAdminData
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
     * @return TempAdminData
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
     * Set cluster
     *
     * @param string $cluster
     *
     * @return TempAdminData
     */
    public function setCluster($cluster)
    {
        $this->cluster = $cluster;

        return $this;
    }

    /**
     * Get cluster
     *
     * @return string
     */
    public function getCluster()
    {
        return $this->cluster;
    }

    /**
     * Set targetPop
     *
     * @param string $targetPop
     *
     * @return TempAdminData
     */
    public function setTargetPop($targetPop)
    {
        $this->targetPop = $targetPop;

        return $this;
    }

    /**
     * Get targetPop
     *
     * @return string
     */
    public function getTargetPop()
    {
        return $this->targetPop;
    }

    /**
     * Set givenVials
     *
     * @param integer $givenVials
     *
     * @return TempAdminData
     */
    public function setGivenVials($givenVials)
    {
        $this->givenVials = $givenVials;

        return $this;
    }

    /**
     * Get givenVials
     *
     * @return integer
     */
    public function getGivenVials()
    {
        return $this->givenVials;
    }

    /**
     * Set usedVials
     *
     * @param integer $usedVials
     *
     * @return TempAdminData
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
     * @return TempAdminData
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
     * @return TempAdminData
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
     * @return TempAdminData
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
     * @return TempAdminData
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
     * @return TempAdminData
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
     * @return TempAdminData
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
     * @return TempAdminData
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
     * @return TempAdminData
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
     * @return TempAdminData
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
     * @return TempAdminData
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
     * Set campaignId
     *
     * @param integer $campaignId
     *
     * @return TempAdminData
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
