<?php
/**
 * Created by PhpStorm.
 * User: nebojsa.manojlovic
 * Date: 7/23/17
 * Time: 19:57
 */

namespace Model;

class VacationRequest
{
    const STATUS_APPROVED = 1;
    const STATUS_PENDING = 2;
    const STATUS_REJECTED = 3;

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
    private $requestedDays;

    /**
     * @var int
     */
    private $status;

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
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return int
     */
    public function getRequestedDays()
    {
        return $this->requestedDays;
    }

    /**
     * @param int $requestedDays
     */
    public function setRequestedDays($requestedDays)
    {
        $this->requestedDays = $requestedDays;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function mapResult($result)
    {
        $this->id = $result['id'];
        $this->user = $result['user_id']; // TODO: this has to be an instance of User model
        $this->requestedDays = $result['requested_days'];
        $this->status = $result['status'];
    }

    public function getColumnNamesForSave()
    {
        return 'user_id, requested_days, status';
    }

    public function getColumnsForUpdate()
    {
        return [
            'id' => $this->getId(),
            'user_id' => $this->getUser()->getId(),
            'requested_days' => $this->getRequestedDays(),
            'status' => $this->getStatus()
        ];
    }
}