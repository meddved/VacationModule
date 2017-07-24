<?php
/**
 * Created by PhpStorm.
 * User: nebojsa.manojlovic
 * Date: 7/24/17
 * Time: 03:03
 */

namespace Repository;

use Model\VacationDays;

/**
 * Interface VacationDaysRepositoryInterface
 * @package Repository
 */
interface VacationDaysRepositoryInterface
{
    /**
     * @param int $id
     * @return VacationDays
     */
    public function findById($id);

    /**
     * @return VacationDays[]
     */
    public function findAll();
}