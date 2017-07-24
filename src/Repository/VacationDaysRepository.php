<?php
/**
 * Created by PhpStorm.
 * User: nebojsa.manojlovic
 * Date: 7/24/17
 * Time: 03:05
 */

namespace Repository;

use DbAdapter\DbAdapterInterface;
use Model\VacationDays;

/**
 * Class VacationDaysRepository
 * @package Repository
 */
class VacationDaysRepository implements VacationDaysRepositoryInterface
{
    const TABLE_NAME = 'vacation_days';
    const COLUMN_NAME_ID = 'id';

    /**
     * @var DbAdapterInterface
     */
    private $connection;

    /**
     * VacationRequestRepository constructor.
     *
     * @param DbAdapterInterface $connection
     */
    public function __construct(DbAdapterInterface $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @param int $id
     * @return VacationDays
     */
    public function findById($id)
    {
        return $this->connection->findBy(
            VacationDaysRepository::COLUMN_NAME_ID,
            $id,
            VacationDaysRepository::TABLE_NAME,
            VacationDays::class
        );
    }

    /**
     * @return VacationDays[]
     */
    public function findAll()
    {
        return $this->connection->findAll(VacationDaysRepository::TABLE_NAME, VacationDays::class);
    }
}