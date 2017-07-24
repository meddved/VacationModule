<?php
/**
 * Created by PhpStorm.
 * User: nebojsa.manojlovic
 * Date: 7/24/17
 * Time: 00:21
 */

namespace Repository;

use Model\User;

interface UserRepositoryInterface
{
    /**
     * @param int $id
     * @return User
     */
    public function findById($id);

    /**
     * @return User[]
     */
    public function findAll();

    /**
     * @param string $username
     * @return User
     */
    public function findByUsername($username);
}