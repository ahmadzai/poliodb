<?php

namespace App\PolioDbBundle\Entity;

/**
 * Users
 */
class Users
{
    /**
     * @var string
     */
    private $userName;

    /**
     * @var string
     */
    private $userEmail;

    /**
     * @var string
     */
    private $userPassword;

    /**
     * @var \DateTime
     */
    private $userCreationTime;

    /**
     * @var \DateTime
     */
    private $userLastLogin;

    /**
     * @var integer
     */
    private $userId;


    /**
     * Set userName
     *
     * @param string $userName
     *
     * @return Users
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;

        return $this;
    }

    /**
     * Get userName
     *
     * @return string
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * Set userEmail
     *
     * @param string $userEmail
     *
     * @return Users
     */
    public function setUserEmail($userEmail)
    {
        $this->userEmail = $userEmail;

        return $this;
    }

    /**
     * Get userEmail
     *
     * @return string
     */
    public function getUserEmail()
    {
        return $this->userEmail;
    }

    /**
     * Set userPassword
     *
     * @param string $userPassword
     *
     * @return Users
     */
    public function setUserPassword($userPassword)
    {
        $this->userPassword = $userPassword;

        return $this;
    }

    /**
     * Get userPassword
     *
     * @return string
     */
    public function getUserPassword()
    {
        return $this->userPassword;
    }

    /**
     * Set userCreationTime
     *
     * @param \DateTime $userCreationTime
     *
     * @return Users
     */
    public function setUserCreationTime($userCreationTime)
    {
        $this->userCreationTime = $userCreationTime;

        return $this;
    }

    /**
     * Get userCreationTime
     *
     * @return \DateTime
     */
    public function getUserCreationTime()
    {
        return $this->userCreationTime;
    }

    /**
     * Set userLastLogin
     *
     * @param \DateTime $userLastLogin
     *
     * @return Users
     */
    public function setUserLastLogin($userLastLogin)
    {
        $this->userLastLogin = $userLastLogin;

        return $this;
    }

    /**
     * Get userLastLogin
     *
     * @return \DateTime
     */
    public function getUserLastLogin()
    {
        return $this->userLastLogin;
    }

    /**
     * Get userId
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->userId;
    }
}

