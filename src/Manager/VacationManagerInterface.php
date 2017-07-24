<?php
/**
 * Created by PhpStorm.
 * User: nebojsa.manojlovic
 * Date: 7/24/17
 * Time: 00:04
 */

namespace Manager;

use Model\User;
use Model\VacationDays;
use Model\VacationRequest;

interface VacationManagerInterface
{
    /**
     * @param VacationRequest $request
     *
     * @return mixed
     */
    public function approveVacationRequest(VacationRequest $request);

    /**
     * @param VacationRequest $request
     * @return mixed
     */
    public function rejectVacationRequest(VacationRequest $request);

    /**
     * @param VacationRequest $request
     * @param VacationDays $vacationDays
     * @param User $user
     * 
     * @return int
     */
    public function calculateRemainingDays(VacationRequest $request, VacationDays $vacationDays, User $user);
}