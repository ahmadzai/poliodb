<?php

namespace App\PolioDbBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PhonesDist
 *
 * @ORM\Table(name="phones_dist")
 * @ORM\Entity
 */
class PhonesDist
{
    /**
     * @var string
     *
     * @ORM\Column(name="r_name", type="string", length=50, nullable=false)
     */
    private $rName;

    /**
     * @var string
     *
     * @ORM\Column(name="r_region", type="string", length=10, nullable=false)
     */
    private $rRegion;

    /**
     * @var string
     *
     * @ORM\Column(name="r_province", type="string", length=25, nullable=false)
     */
    private $rProvince;

    /**
     * @var string
     *
     * @ORM\Column(name="r_district", type="string", length=25, nullable=false)
     */
    private $rDistrict;

    /**
     * @var string
     *
     * @ORM\Column(name="r_title", type="string", length=20, nullable=false)
     */
    private $rTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="r_supervisor", type="string", length=30, nullable=false)
     */
    private $rSupervisor;

    /**
     * @var string
     *
     * @ORM\Column(name="r_nid_no", type="string", length=20, nullable=false)
     */
    private $rNidNo;

    /**
     * @var string
     *
     * @ORM\Column(name="r_mobile_no", type="string", length=20, nullable=false)
     */
    private $rMobileNo;

    /**
     * @var string
     *
     * @ORM\Column(name="r_email", type="string", length=30, nullable=false)
     */
    private $rEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="r_imei_1", type="string", length=50, nullable=false)
     */
    private $rImei1;

    /**
     * @var string
     *
     * @ORM\Column(name="r_imei_2", type="string", length=50, nullable=false)
     */
    private $rImei2;

    /**
     * @var string
     *
     * @ORM\Column(name="phone_type", type="string", length=25, nullable=false)
     */
    private $phoneType;

    /**
     * @var string
     *
     * @ORM\Column(name="r_date", type="string", length=25, nullable=false)
     */
    private $rDate;

    /**
     * @var string
     *
     * @ORM\Column(name="return_date", type="string", length=25, nullable=false)
     */
    private $returnDate;

    /**
     * @var string
     *
     * @ORM\Column(name="remarks", type="text", length=65535, nullable=false)
     */
    private $remarks;

    /**
     * @var integer
     *
     * @ORM\Column(name="dist_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $distId;



    /**
     * Set rName
     *
     * @param string $rName
     *
     * @return PhonesDist
     */
    public function setRName($rName)
    {
        $this->rName = $rName;

        return $this;
    }

    /**
     * Get rName
     *
     * @return string
     */
    public function getRName()
    {
        return $this->rName;
    }

    /**
     * Set rRegion
     *
     * @param string $rRegion
     *
     * @return PhonesDist
     */
    public function setRRegion($rRegion)
    {
        $this->rRegion = $rRegion;

        return $this;
    }

    /**
     * Get rRegion
     *
     * @return string
     */
    public function getRRegion()
    {
        return $this->rRegion;
    }

    /**
     * Set rProvince
     *
     * @param string $rProvince
     *
     * @return PhonesDist
     */
    public function setRProvince($rProvince)
    {
        $this->rProvince = $rProvince;

        return $this;
    }

    /**
     * Get rProvince
     *
     * @return string
     */
    public function getRProvince()
    {
        return $this->rProvince;
    }

    /**
     * Set rDistrict
     *
     * @param string $rDistrict
     *
     * @return PhonesDist
     */
    public function setRDistrict($rDistrict)
    {
        $this->rDistrict = $rDistrict;

        return $this;
    }

    /**
     * Get rDistrict
     *
     * @return string
     */
    public function getRDistrict()
    {
        return $this->rDistrict;
    }

    /**
     * Set rTitle
     *
     * @param string $rTitle
     *
     * @return PhonesDist
     */
    public function setRTitle($rTitle)
    {
        $this->rTitle = $rTitle;

        return $this;
    }

    /**
     * Get rTitle
     *
     * @return string
     */
    public function getRTitle()
    {
        return $this->rTitle;
    }

    /**
     * Set rSupervisor
     *
     * @param string $rSupervisor
     *
     * @return PhonesDist
     */
    public function setRSupervisor($rSupervisor)
    {
        $this->rSupervisor = $rSupervisor;

        return $this;
    }

    /**
     * Get rSupervisor
     *
     * @return string
     */
    public function getRSupervisor()
    {
        return $this->rSupervisor;
    }

    /**
     * Set rNidNo
     *
     * @param string $rNidNo
     *
     * @return PhonesDist
     */
    public function setRNidNo($rNidNo)
    {
        $this->rNidNo = $rNidNo;

        return $this;
    }

    /**
     * Get rNidNo
     *
     * @return string
     */
    public function getRNidNo()
    {
        return $this->rNidNo;
    }

    /**
     * Set rMobileNo
     *
     * @param string $rMobileNo
     *
     * @return PhonesDist
     */
    public function setRMobileNo($rMobileNo)
    {
        $this->rMobileNo = $rMobileNo;

        return $this;
    }

    /**
     * Get rMobileNo
     *
     * @return string
     */
    public function getRMobileNo()
    {
        return $this->rMobileNo;
    }

    /**
     * Set rEmail
     *
     * @param string $rEmail
     *
     * @return PhonesDist
     */
    public function setREmail($rEmail)
    {
        $this->rEmail = $rEmail;

        return $this;
    }

    /**
     * Get rEmail
     *
     * @return string
     */
    public function getREmail()
    {
        return $this->rEmail;
    }

    /**
     * Set rImei1
     *
     * @param string $rImei1
     *
     * @return PhonesDist
     */
    public function setRImei1($rImei1)
    {
        $this->rImei1 = $rImei1;

        return $this;
    }

    /**
     * Get rImei1
     *
     * @return string
     */
    public function getRImei1()
    {
        return $this->rImei1;
    }

    /**
     * Set rImei2
     *
     * @param string $rImei2
     *
     * @return PhonesDist
     */
    public function setRImei2($rImei2)
    {
        $this->rImei2 = $rImei2;

        return $this;
    }

    /**
     * Get rImei2
     *
     * @return string
     */
    public function getRImei2()
    {
        return $this->rImei2;
    }

    /**
     * Set phoneType
     *
     * @param string $phoneType
     *
     * @return PhonesDist
     */
    public function setPhoneType($phoneType)
    {
        $this->phoneType = $phoneType;

        return $this;
    }

    /**
     * Get phoneType
     *
     * @return string
     */
    public function getPhoneType()
    {
        return $this->phoneType;
    }

    /**
     * Set rDate
     *
     * @param string $rDate
     *
     * @return PhonesDist
     */
    public function setRDate($rDate)
    {
        $this->rDate = $rDate;

        return $this;
    }

    /**
     * Get rDate
     *
     * @return string
     */
    public function getRDate()
    {
        return $this->rDate;
    }

    /**
     * Set returnDate
     *
     * @param string $returnDate
     *
     * @return PhonesDist
     */
    public function setReturnDate($returnDate)
    {
        $this->returnDate = $returnDate;

        return $this;
    }

    /**
     * Get returnDate
     *
     * @return string
     */
    public function getReturnDate()
    {
        return $this->returnDate;
    }

    /**
     * Set remarks
     *
     * @param string $remarks
     *
     * @return PhonesDist
     */
    public function setRemarks($remarks)
    {
        $this->remarks = $remarks;

        return $this;
    }

    /**
     * Get remarks
     *
     * @return string
     */
    public function getRemarks()
    {
        return $this->remarks;
    }

    /**
     * Get distId
     *
     * @return integer
     */
    public function getDistId()
    {
        return $this->distId;
    }
}
