<?php
/**
 * Created by PhpStorm.
 * User: nebojsa.manojlovic
 * Date: 7/23/17
 * Time: 19:00
 */

namespace Repository;

use DbAdapter\DbAdapterInterface;
use Model\User;
use Model\VacationRequest;

/**
 * Class VacationRequestRepository
 * @package Repository
 */
class VacationRequestRepository implements VacationRequestRepositoryInterface
{
    const TABLE_NAME = 'vacation_requests';
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
     * @inheritdoc
     */
    public function findById($id)
    {
         return $this->connection->findBy(
            VacationRequestRepository::COLUMN_NAME_ID,
            $id,
            VacationRequestRepository::TABLE_NAME,
            VacationRequest::class
        );
    }

    /**
     * @inheritdoc
     */
    public function save(VacationRequest $request)
    {
        if ($request->getId()) {
            return $this->update($request);
        } else {
            return $this->create($request);
        }
    }

    /**
     * @param VacationRequest $request
     *
     * @return mixed|VacationRequest
     */
    private function create(VacationRequest $request)
    {
        $values = $request->getUserId() .
            ',' . $request->getRequestedDays() .
            ',\'' . $request->getStatus() . '\'';

        $id = $this->connection->save(
            VacationRequestRepository::TABLE_NAME,
            $request->getColumnNamesForSave(),
            $values
        );

        return $this->findById($id);
    }

    /**
     * @param VacationRequest $request
     *
     * @return bool|VacationRequest
     */
    private function update(VacationRequest $request)
    {
        $columns = $request->getColumnsForUpdate();
        
        $result = $this->connection->update(VacationRequestRepository::TABLE_NAME, $columns);

        if ($result) {
            return $request;
        }

        return false;
    }

    /**
     * @inheritdoc
     */
    public function remove(VacationRequest $request)
    {
        $this->connection->remove($request, VacationRequestRepository::TABLE_NAME);
    }

    /**
     * @return VacationRequest[]
     */
    public function findAll()
    {
        return $this->connection->findAll(VacationRequestRepository::TABLE_NAME, VacationRequest::class);
    }

    /**
     * @param User $user
     * @return int
     */
    public function getTotalApprovedDays(User $user)
    {
        $query = 'SELECT sum(requested_days) as total_approved_days
        FROM ' . VacationRequestRepository::TABLE_NAME . ' 
        WHERE user_id = ' . $user->getId() . ' AND status = ' . VacationRequest::STATUS_APPROVED;

        $result = $this->connection->select($query);

        return $result[0]['total_approved_days'];
    }
}