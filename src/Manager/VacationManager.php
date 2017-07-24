<?php
/**
 * Created by PhpStorm.
 * User: nebojsa.manojlovic
 * Date: 7/22/17
 * Time: 23:55
 */

namespace Manager;

use Model\User;
use Model\VacationDays;
use Model\VacationRequest;
use Repository\VacationRequestRepositoryInterface;

/**
 * Class VacationManager
 * @package VacationManager
 */
class VacationManager implements VacationManagerInterface
{
    /**
     * @var VacationRequestRepositoryInterface
     */
    private $vacationRepository;

    /**
     * VacationManager constructor.
     * @param VacationRequestRepositoryInterface $vacationRepository
     */
    public function __construct(VacationRequestRepositoryInterface $vacationRepository)
    {
        $this->vacationRepository = $vacationRepository;
    }

    /**
     * @inheritdoc
     */
    public function approveVacationRequest(VacationRequest $request)
    {
        $request->setStatus(VacationRequest::STATUS_APPROVED);

        return $this->vacationRepository->save($request);
    }

    /**
     * @inheritdoc
     */
    public function rejectVacationRequest(VacationRequest $request)
    {
        $request->setStatus(VacationRequest::STATUS_REJECTED);

        return $this->vacationRepository->save($request);
    }

    /**
     * @inheritdoc
     */
    public function calculateRemainingDays(VacationRequest $request, VacationDays $vacationDays, User $user)
    {
        return $vacationDays->getDays() - $this->vacationRepository->getTotalApprovedDays($user);
    }
}
