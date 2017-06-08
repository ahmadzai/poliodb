<?php

namespace App\PolioDbBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="test_data")
 */
class Testdata
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $email;

    /**
     * Get id
     *
     * @return integer
     */

     /**
      * @ORM\Column(type="string", length=200, nullable=true)
      */
     private $textarea1;

      /**
       * Get regions
       *
       * @return string
       */
     public function getTextarea1() {
          return $this->textarea1;
      }
      /**
       * Set regions
       *
       * @param string $regions
       *
       * @return Testdata
       */
     public function setTextarea1($textarea1 /* = null, if optional */) {
          $this->textarea1 = $textarea1;
     }


     /**
      * @ORM\Column(type="string", length=100, nullable=true)
      */
     private $regions;

      /**
       * Get regions
       *
       * @return string
       */
     public function getRegions() {
          return $this->regions;
      }
      /**
       * Set regions
       *
       * @param string $regions
       *
       * @return Testdata
       */
    public function setRegions($regions /* = null, if optional */) {
          $this->regions = $regions;
    }

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
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return Testdata
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Testdata
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }
}
