<?php

namespace App\PolioDbBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Region
 *
 * @ORM\Table(name="region", uniqueConstraints={@ORM\UniqueConstraint(name="region_name_UNIQUE", columns={"region_name"})})
 * @ORM\Entity
 */
class Region
{

  /**
   * @var integer
   *
   * @ORM\Column(name="region_code", type="integer")
   */
    private $regionCode;

    /**
     * @var string
     *
     * @ORM\Column(name="region_name", type="string", length=255)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $regionName;


    public function __toString() {
    return (string) $this->provinceCode;
    }
}
