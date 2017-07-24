<?php
/**
 * Created by PhpStorm.
 * User: nebojsa.manojlovic
 * Date: 7/24/17
 * Time: 03:04
 */

namespace Model;

class VacationDays
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var User
     */
    private $user;

    /**
     * @var int
     */
    private $days;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getDays()
    {
        return $this->days;
    }

    /**
     * @param mixed $days
     */
    public function setDays($days)
    {
        $this->days = $days;
    }

    public function mapResult($result)
    {
        $this->id = $result['id'];
        $this->user = $result['user_id']; // TODO: this has to be an instance of User model
        $this->days = $result['days'];
    }
}