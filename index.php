<?php
/**
 * Created by PhpStorm.
 * User: nebojsa.manojlovic
 * Date: 7/23/17
 * Time: 17:15
 */

require_once('src/Autoloader.php');

use DbAdapter\MySqlAdapter;
use Model\VacationRequest;
use Repository\UserRepository;
use Repository\VacationDaysRepository;
use Repository\VacationRequestRepository;
use Manager\VacationManager;

$db = new MySqlAdapter();

$userRepo = new UserRepository($db);
$vacationRequestRepository = new VacationRequestRepository($db);
$vacationDaysRepository = new VacationDaysRepository($db);
$vacationManager = new VacationManager($vacationRequestRepository);

$user = $userRepo->findById(2);

$vacationDays = $vacationDaysRepository->findById($user->getId());
echo 'Total vacation days: ' . $vacationDays->getDays();
echo "\n";
echo "\n";

$vacationRequest1 = new VacationRequest();
$vacationRequest1->setRequestedDays(3);
$vacationRequest1->setStatus(VacationRequest::STATUS_PENDING);
$vacationRequest1->setUserId($user->getId());
echo 'Requested vacation days: ' . $vacationRequest1->getRequestedDays();
echo "\n";

$remainingDays = $vacationManager->calculateRemainingDays($vacationRequest1, $vacationDays, $user);
echo 'Remaining days before request is approved/rejeceted: ' . $remainingDays;
echo "\n";

$savedRequest = $vacationRequestRepository->save($vacationRequest1);

// approve the first request and show result
$approved = $vacationManager->approveVacationRequest($savedRequest);
echo 'Request is approved.';
echo "\n";

$remainingDays = $vacationManager->calculateRemainingDays($vacationRequest1, $vacationDays, $user);
echo 'Remaining days after approval: ' . $remainingDays;
echo "\n";

$vacationRequest2 = new VacationRequest();
$vacationRequest2->setRequestedDays(4);
$vacationRequest2->setStatus(VacationRequest::STATUS_PENDING);
$vacationRequest2->setUserId($user->getId());
echo 'Requested vacation days: ' . $vacationRequest2->getRequestedDays();
echo "\n";

$savedRequest = $vacationRequestRepository->save($vacationRequest1);

// deny second request and show result
$rejected = $vacationManager->rejectVacationRequest($vacationRequest2);
echo 'Request is denied.';
echo "\n";

$remainingDays = $vacationManager->calculateRemainingDays($vacationRequest1, $vacationDays, $user);
echo 'Remaining days after rejection: ' . $remainingDays;
echo "\n";
