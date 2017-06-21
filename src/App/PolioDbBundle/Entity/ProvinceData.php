<?php

namespace App\PolioDbBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Province
 *
 * @ORM\Table(name="province_data")
 * @ORM\Entity(readOnly=true, repositoryClass="App\PolioDbBundle\Entity\ProvinceDataRepository")
 */
class ProvinceData
{
    /**
     * @var string
     *
     * @ORM\Column(name="province_region", type="string", length=10, nullable=true)
     */
    private $provinceRegion;

    /**
     * @var string
     *
     * @ORM\Column(name="province_name", type="string", length=30, nullable=true)
     */
    private $provinceName;


    /**
     * @var integer
     *
     * @ORM\Column(name="province_code", type="integer")
     * @ORM\Id
     */
    private $provinceCode;

    /**
     * Get provinceRegion
     *
     * @return string
     */
    public function getProvinceRegion()
    {
        return $this->provinceRegion;
    }


    /**
     * Get provinceName
     *
     * @return string
     */
    public function getProvinceName()
    {
        return $this->provinceName;
    }

    /**
     * Get provinceCode
     *
     * @return integer
     */
    public function getProvinceCode()
    {
        return $this->provinceCode;
    }

    /**
     * Set provinceRegion
     *
     * @param string $provinceRegion
     *
     * @return ProvinceData
     */
    public function setProvinceRegion($provinceRegion)
    {
        $this->provinceRegion = $provinceRegion;

        return $this;
    }

    /**
     * Set provinceName
     *
     * @param string $provinceName
     *
     * @return ProvinceData
     */
    public function setProvinceName($provinceName)
    {
        $this->provinceName = $provinceName;

        return $this;
    }

    /**
     * Set provinceCode
     *
     * @param integer $provinceCode
     *
     * @return ProvinceData
     */
    public function setProvinceCode($provinceCode)
    {
        $this->provinceCode = $provinceCode;

        return $this;
    }
}
