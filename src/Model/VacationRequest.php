<?php
/**
 * Created by PhpStorm.
 * User: nebojsa.manojlovic
 * Date: 7/23/17
 * Time: 19:57
 */

namespace Model;

/**
 * Class VacationRequest
 * @package Model
 */
class VacationRequest implements ModelInterface
{
    const STATUS_APPROVED = 1;
    const STATUS_PENDING = 2;
    const STATUS_REJECTED = 3;

    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $userId;

    /**
     * @var int
     */
    private $requestedDays;

    /**
     * @var int
     */
    private $status;

    public function __construct()
    {
    }

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
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
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

    /**
     * @param array $result
     */
    public function mapResult(array $result)
    {
        $this->id = $result['id'];
        $this->userId =  $result['user_id'];
        $this->requestedDays = $result['requested_days'];
        $this->status = $result['status'];
    }

    /**
     * @return string
     */
    public function getColumnNamesForSave()
    {
        return 'user_id, requested_days, status';
    }

    /**
     * @return array
     */
    public function getColumnsForUpdate()
    {
        return [
            'id' => $this->getId(),
            'user_id' => $this->getUserId(),
            'requested_days' => $this->getRequestedDays(),
            'status' => $this->getStatus()
        ];
    }
}