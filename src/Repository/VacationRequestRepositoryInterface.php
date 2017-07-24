<?php
/**
 * Created by PhpStorm.
 * User: nebojsa.manojlovic
 * Date: 7/23/17
 * Time: 19:50
 */

namespace Repository;

use Model\User;
use Model\VacationRequest;

interface VacationRequestRepositoryInterface
{
    /**
     * @param int $id
     *
     * @return VacationRequest
     */
    public function findById($id);

    /**
     * @return VacationRequest[]
     */
    public function findAll();

    /**
     * @param VacationRequest $request
     *
     * @return mixed
     */
    public function save(VacationRequest $request);

    /**
     * @param VacationRequest $request
     *
     * @return mixed
     */
    public function remove(VacationRequest $request);

    /**
     * @param User $user
     * @return int
     */
    public function getTotalApprovedDays(User $user);
}