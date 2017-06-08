<?php

namespace App\PolioDbBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * District
 *
 * @ORM\Table(name="district", uniqueConstraints={@ORM\UniqueConstraint(name="district_code_UNIQUE", columns={"district_code"})}, indexes={@ORM\Index(name="fk_d_p_idx", columns={"province_code"})})
 * @ORM\Entity
 */
class District
{

    /**
     * @var string
     *
     * @ORM\Column(name="district_name", type="text", length=65535, nullable=true)
     */
    private $districtName;

    /**
     * @var string
     *
     * @ORM\Column(name="district_name_alt", type="text", length=65535, nullable=true)
     */
    private $districtNameAlt;

    /**
     * @var string
     *
     * @ORM\Column(name="district_name_pashtu", type="text", length=65535, nullable=true)
     */
    private $districtNamePashtu;

    /**
     * @var string
     *
     * @ORM\Column(name="district_name_dari", type="text", length=65535, nullable=true)
     */
    private $districtNameDari;

    /**
     * @var string
     *
     * @ORM\Column(name="district_lpd_status", type="text", length=65535, nullable=true)
     */
    private $districtLpdStatus;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="entry_date", type="datetime", nullable=true)
     */
    private $entryDate = 'CURRENT_TIMESTAMP';

    /**
     * @var integer
     *
     * @ORM\Column(name="district_code", type="integer")
     * @ORM\Id
     */
    private $districtCode;

    /**
     * @var \App\PolioDbBundle\Entity\Province
     *
     * @ORM\ManyToOne(targetEntity="App\PolioDbBundle\Entity\Province")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="province_code", referencedColumnName="province_code")
     * })
     */
    private $provinceCode;



    /**
     * Set districtName
     *
     * @param string $districtName
     *
     * @return District
     */
    public function setDistrictName($districtName)
    {
        $this->districtName = $districtName;

        return $this;
    }

    /**
     * Get districtName
     *
     * @return string
     */
    public function getDistrictName()
    {
        return $this->districtName;
    }

    /**
     * Set districtNameAlt
     *
     * @param string $districtNameAlt
     *
     * @return District
     */
    public function setDistrictNameAlt($districtNameAlt)
    {
        $this->districtNameAlt = $districtNameAlt;

        return $this;
    }

    /**
     * Get districtNameAlt
     *
     * @return string
     */
    public function getDistrictNameAlt()
    {
        return $this->districtNameAlt;
    }

    /**
     * Set districtNamePashtu
     *
     * @param string $districtNamePashtu
     *
     * @return District
     */
    public function setDistrictNamePashtu($districtNamePashtu)
    {
        $this->districtNamePashtu = $districtNamePashtu;

        return $this;
    }

    /**
     * Get districtNamePashtu
     *
     * @return string
     */
    public function getDistrictNamePashtu()
    {
        return $this->districtNamePashtu;
    }

    /**
     * Set districtNameDari
     *
     * @param string $districtNameDari
     *
     * @return District
     */
    public function setDistrictNameDari($districtNameDari)
    {
        $this->districtNameDari = $districtNameDari;

        return $this;
    }

    /**
     * Get districtNameDari
     *
     * @return string
     */
    public function getDistrictNameDari()
    {
        return $this->districtNameDari;
    }

    /**
     * Set districtLpdStatus
     *
     * @param string $districtLpdStatus
     *
     * @return District
     */
    public function setDistrictLpdStatus($districtLpdStatus)
    {
        $this->districtLpdStatus = $districtLpdStatus;

        return $this;
    }

    /**
     * Get districtLpdStatus
     *
     * @return string
     */
    public function getDistrictLpdStatus()
    {
        return $this->districtLpdStatus;
    }

    /**
     * Set entryDate
     *
     * @param \DateTime $entryDate
     *
     * @return District
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
        $this->entryDate = new \DateTime();
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
     * @param int $districtCode
     */
    public function setDistrictCode($districtCode)
    {
        $this->districtCode = $districtCode;
    }

    /**
     * Set provinceCode
     *
     * @param \App\PolioDbBundle\Entity\Province $provinceCode
     *
     * @return District
     */
    public function setProvinceCode(\App\PolioDbBundle\Entity\Province $provinceCode = null)
    {
        $this->provinceCode = $provinceCode;

        return $this;
    }

    /**
     * Get provinceCode
     *
     * @return \App\PolioDbBundle\Entity\Province
     */
    public function getProvinceCode()
    {
        return $this->provinceCode;
    }
}
