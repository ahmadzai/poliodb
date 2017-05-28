<?php

namespace App\PolioDbBundle\Entity;

/**
 * AclEntries
 */
class AclEntries
{
    /**
     * @var string
     */
    private $fieldName;

    /**
     * @var integer
     */
    private $aceOrder;

    /**
     * @var integer
     */
    private $mask;

    /**
     * @var boolean
     */
    private $granting;

    /**
     * @var string
     */
    private $grantingStrategy;

    /**
     * @var boolean
     */
    private $auditSuccess;

    /**
     * @var boolean
     */
    private $auditFailure;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \App\PolioDbBundle\Entity\AclClasses
     */
    private $class;

    /**
     * @var \App\PolioDbBundle\Entity\AclSecurityIdentities
     */
    private $securityentity;

    /**
     * @var \App\PolioDbBundle\Entity\AclObjectIdentities
     */
    private $objectentity;


    /**
     * Set fieldName
     *
     * @param string $fieldName
     *
     * @return AclEntries
     */
    public function setFieldName($fieldName)
    {
        $this->fieldName = $fieldName;

        return $this;
    }

    /**
     * Get fieldName
     *
     * @return string
     */
    public function getFieldName()
    {
        return $this->fieldName;
    }

    /**
     * Set aceOrder
     *
     * @param integer $aceOrder
     *
     * @return AclEntries
     */
    public function setAceOrder($aceOrder)
    {
        $this->aceOrder = $aceOrder;

        return $this;
    }

    /**
     * Get aceOrder
     *
     * @return integer
     */
    public function getAceOrder()
    {
        return $this->aceOrder;
    }

    /**
     * Set mask
     *
     * @param integer $mask
     *
     * @return AclEntries
     */
    public function setMask($mask)
    {
        $this->mask = $mask;

        return $this;
    }

    /**
     * Get mask
     *
     * @return integer
     */
    public function getMask()
    {
        return $this->mask;
    }

    /**
     * Set granting
     *
     * @param boolean $granting
     *
     * @return AclEntries
     */
    public function setGranting($granting)
    {
        $this->granting = $granting;

        return $this;
    }

    /**
     * Get granting
     *
     * @return boolean
     */
    public function getGranting()
    {
        return $this->granting;
    }

    /**
     * Set grantingStrategy
     *
     * @param string $grantingStrategy
     *
     * @return AclEntries
     */
    public function setGrantingStrategy($grantingStrategy)
    {
        $this->grantingStrategy = $grantingStrategy;

        return $this;
    }

    /**
     * Get grantingStrategy
     *
     * @return string
     */
    public function getGrantingStrategy()
    {
        return $this->grantingStrategy;
    }

    /**
     * Set auditSuccess
     *
     * @param boolean $auditSuccess
     *
     * @return AclEntries
     */
    public function setAuditSuccess($auditSuccess)
    {
        $this->auditSuccess = $auditSuccess;

        return $this;
    }

    /**
     * Get auditSuccess
     *
     * @return boolean
     */
    public function getAuditSuccess()
    {
        return $this->auditSuccess;
    }

    /**
     * Set auditFailure
     *
     * @param boolean $auditFailure
     *
     * @return AclEntries
     */
    public function setAuditFailure($auditFailure)
    {
        $this->auditFailure = $auditFailure;

        return $this;
    }

    /**
     * Get auditFailure
     *
     * @return boolean
     */
    public function getAuditFailure()
    {
        return $this->auditFailure;
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
     * Set class
     *
     * @param \App\PolioDbBundle\Entity\AclClasses $class
     *
     * @return AclEntries
     */
    public function setClass(\App\PolioDbBundle\Entity\AclClasses $class = null)
    {
        $this->class = $class;

        return $this;
    }

    /**
     * Get class
     *
     * @return \App\PolioDbBundle\Entity\AclClasses
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * Set securityentity
     *
     * @param \App\PolioDbBundle\Entity\AclSecurityIdentities $securityentity
     *
     * @return AclEntries
     */
    public function setSecurityentity(\App\PolioDbBundle\Entity\AclSecurityIdentities $securityentity = null)
    {
        $this->securityentity = $securityentity;

        return $this;
    }

    /**
     * Get securityentity
     *
     * @return \App\PolioDbBundle\Entity\AclSecurityIdentities
     */
    public function getSecurityentity()
    {
        return $this->securityentity;
    }

    /**
     * Set objectentity
     *
     * @param \App\PolioDbBundle\Entity\AclObjectIdentities $objectentity
     *
     * @return AclEntries
     */
    public function setObjectentity(\App\PolioDbBundle\Entity\AclObjectIdentities $objectentity = null)
    {
        $this->objectentity = $objectentity;

        return $this;
    }

    /**
     * Get objectentity
     *
     * @return \App\PolioDbBundle\Entity\AclObjectIdentities
     */
    public function getObjectentity()
    {
        return $this->objectentity;
    }
}

