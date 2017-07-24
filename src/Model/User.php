<?php
/**
 * Created by PhpStorm.
 * User: nebojsa.manojlovic
 * Date: 7/23/17
 * Time: 19:38
 */

namespace Model;

class User
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $username;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string
     */
    private $lastName;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    public function mapResult($result)
    {
        $this->id = $result['id'];
        $this->username = $result['username'];
        $this->createdAt = $result['created_at'];
        $this->firstName = $result['first_name'];
        $this->lastName = $result['last_name'];
    }

    public function getColumnNamesForSave()
    {
        return 'username, created_at, first_name, last_name';
    }
}