<?php

namespace App\PolioDbBundle\Entity;

/**
 * AclObjectIdentities
 */
class AclObjectIdentities
{
    /**
     * @var integer
     */
    private $classId;

    /**
     * @var string
     */
    private $objectIdentifier;

    /**
     * @var boolean
     */
    private $entriesInheriting;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \App\PolioDbBundle\Entity\AclObjectIdentities
     */
    private $parentObjectentity;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $ancestor;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->ancestor = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set classId
     *
     * @param integer $classId
     *
     * @return AclObjectIdentities
     */
    public function setClassId($classId)
    {
        $this->classId = $classId;

        return $this;
    }

    /**
     * Get classId
     *
     * @return integer
     */
    public function getClassId()
    {
        return $this->classId;
    }

    /**
     * Set objectIdentifier
     *
     * @param string $objectIdentifier
     *
     * @return AclObjectIdentities
     */
    public function setObjectIdentifier($objectIdentifier)
    {
        $this->objectIdentifier = $objectIdentifier;

        return $this;
    }

    /**
     * Get objectIdentifier
     *
     * @return string
     */
    public function getObjectIdentifier()
    {
        return $this->objectIdentifier;
    }

    /**
     * Set entriesInheriting
     *
     * @param boolean $entriesInheriting
     *
     * @return AclObjectIdentities
     */
    public function setEntriesInheriting($entriesInheriting)
    {
        $this->entriesInheriting = $entriesInheriting;

        return $this;
    }

    /**
     * Get entriesInheriting
     *
     * @return boolean
     */
    public function getEntriesInheriting()
    {
        return $this->entriesInheriting;
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

    /**
     * Set parentObjectentity
     *
     * @param \App\PolioDbBundle\Entity\AclObjectIdentities $parentObjectentity
     *
     * @return AclObjectIdentities
     */
    public function setParentObjectentity(\App\PolioDbBundle\Entity\AclObjectIdentities $parentObjectentity = null)
    {
        $this->parentObjectentity = $parentObjectentity;

        return $this;
    }

    /**
     * Get parentObjectentity
     *
     * @return \App\PolioDbBundle\Entity\AclObjectIdentities
     */
    public function getParentObjectentity()
    {
        return $this->parentObjectentity;
    }

    /**
     * Add ancestor
     *
     * @param \App\PolioDbBundle\Entity\AclObjectIdentities $ancestor
     *
     * @return AclObjectIdentities
     */
    public function addAncestor(\App\PolioDbBundle\Entity\AclObjectIdentities $ancestor)
    {
        $this->ancestor[] = $ancestor;

        return $this;
    }

    /**
     * Remove ancestor
     *
     * @param \App\PolioDbBundle\Entity\AclObjectIdentities $ancestor
     */
    public function removeAncestor(\App\PolioDbBundle\Entity\AclObjectIdentities $ancestor)
    {
        $this->ancestor->removeElement($ancestor);
    }

    /**
     * Get ancestor
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAncestor()
    {
        return $this->ancestor;
    }
}

