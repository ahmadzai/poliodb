<?php

namespace App\PolioDbBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Form\Extension\Core\Type\DateType;

/**
 * Campaign
 *
 * @ORM\Table(name="campaign")
 * @ORM\Entity
 */
class Campaign
{
    /**
     * @var string
     *
     * @ORM\Column(name="campaign_name", type="text", length=65535, nullable=true)
     */
    private $campaignName;

    /**
     * @var string
     *
     * @ORM\Column(name="campaign_type", type="text", length=65535, nullable=true)
     */
    private $campaignType;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="campaign_start_date", type="date", nullable=false)
     */
    private $campaignStartDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="campaign_end_date", type="date", nullable=false)
     */
    private $campaignEndDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="entry_date", type="datetime", nullable=true)
     */
    private $entryDate = 'CURRENT_TIMESTAMP';

    /**
     * @var integer
     *
     * @ORM\Column(name="campaign_year", type="integer", nullable=true)
     */
    private $campaignYear;

    /**
     * @var string
     *
     * @ORM\Column(name="campaign_month", type="string", length=20, nullable=true)
     */
    private $campaignMonth;

    /**
     * @var integer
     *
     * @ORM\Column(name="campaign_id", type="integer")
     * @ORM\Id
     */
    private $campaignId;

//@ORM\GeneratedValue(strategy="IDENTITY")


    /**
     * Set campaignName
     *
     * @param string $campaignName
     *
     * @return Campaign
     */
    public function setCampaignName($campaignName)
    {
        $this->campaignName = $campaignName;

        return $this;
    }

    /**
     * Get campaignName
     *
     * @return string
     */
    public function getCampaignName()
    {
        return $this->campaignName;
    }

    /**
     * Set campaignType
     *
     * @param string $campaignType
     *
     * @return Campaign
     */
    public function setCampaignType($campaignType)
    {
        $this->campaignType = $campaignType;

        return $this;
    }

    /**
     * Get campaignType
     *
     * @return string
     */
    public function getCampaignType()
    {
        return $this->campaignType;
    }

    /**
     * Set campaignStartDate
     *
     * @param \DateTime $campaignStartDate
     *
     * @return Campaign
     */
    public function setCampaignStartDate($campaignStartDate)
    {
        $this->campaignStartDate =  $campaignStartDate;

        return $this;
    }

    /**
     * Get campaignStartDate
     *
     * @return \DateTime
     */
    public function getCampaignStartDate()
    {
        return $this->campaignStartDate;
    }

    /**
     * Set campaignEndDate
     *
     * @param \DateTime $campaignEndDate
     *
     * @return Campaign
     */
    public function setCampaignEndDate($campaignEndDate)
    {
        $this->campaignEndDate =  $campaignEndDate;

        return $this;
    }

    /**
     * Get campaignEndDate
     *
     * @return \DateTime
     */
    public function getCampaignEndDate()
    {
        return $this->campaignEndDate;
    }


    /**
     * Set entryDate
     *
     * @param \DateTime $entryDate
     *
     * @return Campaign
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

    public function __construct()
    {
        $date = new \DateTime();
        $this->entryDate = $date;
        $this->campaignStartDate = $this->campaignEndDate = $date->format('Y-m-d');
    }

    /**
     * Set campaignYear
     *
     * @param integer $campaignYear
     *
     * @return Campaign
     */
    public function setCampaignYear($campaignYear)
    {
        $this->campaignYear = $campaignYear;

        return $this;
    }

    /**
     * Get campaignYear
     *
     * @return integer
     */
    public function getCampaignYear()
    {
        return $this->campaignYear;
    }

    /**
     * Set campaignMonth
     *
     * @param string $campaignMonth
     *
     * @return Campaign
     */
    public function setCampaignMonth($campaignMonth)
    {
        $this->campaignMonth = $campaignMonth;

        return $this;
    }

    /**
     * Get campaignMonth
     *
     * @return string
     */
    public function getCampaignMonth()
    {
        return $this->campaignMonth;
    }

    /**
     * @param int $campaignId
     */
    public function setCampaignId($campaignId)
    {
        $this->campaignId = $campaignId;
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
}
