<?php

namespace App\PolioDbBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Submissions
 *
 * @ORM\Table(name="submissions")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="App\PolioDbBundle\Entity\SubmissionsRepository")
 */
class Submissions
{
    /**
     * @var string
     *
     * @ORM\Column(name="imei", type="string", length=30, nullable=false)
     */
    private $imei;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="position", type="string", length=20, nullable=false)
     */
    private $position;

    /**
     * @var string
     *
     * @ORM\Column(name="region", type="string", length=20, nullable=false)
     */
    private $region;

    /**
     * @var string
     *
     * @ORM\Column(name="province", type="string", length=50, nullable=false)
     */
    private $province;

    /**
     * @var string
     *
     * @ORM\Column(name="district", type="string", length=50, nullable=false)
     */
    private $district;

    /**
     * @var string
     *
     * @ORM\Column(name="form", type="string", length=50, nullable=false)
     */
    private $form;

    /**
     * @var string
     *
     * @ORM\Column(name="year", type="string", length=20, nullable=false)
     */
    private $year;

    /**
     * @var string
     *
     * @ORM\Column(name="month", type="string", length=25, nullable=false)
     */
    private $month;

    /**
     * @var string
     *
     * @ORM\Column(name="submission_date", type="string", length=20, nullable=false)
     */
    private $submissionDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=false)
     */
    private $date = 'CURRENT_TIMESTAMP';

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set imei
     *
     * @param string $imei
     *
     * @return Submissions
     */
    public function setImei($imei)
    {
        $this->imei = $imei;

        return $this;
    }

    /**
     * Get imei
     *
     * @return string
     */
    public function getImei()
    {
        return $this->imei;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Submissions
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set position
     *
     * @param string $position
     *
     * @return Submissions
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return string
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set region
     *
     * @param string $region
     *
     * @return Submissions
     */
    public function setRegion($region)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * Get region
     *
     * @return string
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Set province
     *
     * @param string $province
     *
     * @return Submissions
     */
    public function setProvince($province)
    {
        $this->province = $province;

        return $this;
    }

    /**
     * Get province
     *
     * @return string
     */
    public function getProvince()
    {
        return $this->province;
    }

    /**
     * Set district
     *
     * @param string $district
     *
     * @return Submissions
     */
    public function setDistrict($district)
    {
        $this->district = $district;

        return $this;
    }

    /**
     * Get district
     *
     * @return string
     */
    public function getDistrict()
    {
        return $this->district;
    }

    /**
     * Set form
     *
     * @param string $form
     *
     * @return Submissions
     */
    public function setForm($form)
    {
        $this->form = $form;

        return $this;
    }

    /**
     * Get form
     *
     * @return string
     */
    public function getForm()
    {
        return $this->form;
    }

    /**
     * Set year
     *
     * @param string $year
     *
     * @return Submissions
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year
     *
     * @return string
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set month
     *
     * @param string $month
     *
     * @return Submissions
     */
    public function setMonth($month)
    {
        $this->month = $month;

        return $this;
    }

    /**
     * Get month
     *
     * @return string
     */
    public function getMonth()
    {
        return $this->month;
    }

    /**
     * Set submissionDate
     *
     * @param string $submissionDate
     *
     * @return Submissions
     */
    public function setSubmissionDate($submissionDate)
    {
        $this->submissionDate = $submissionDate;

        return $this;
    }

    /**
     * Get submissionDate
     *
     * @return string
     */
    public function getSubmissionDate()
    {
        return $this->submissionDate;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Submissions
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
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
