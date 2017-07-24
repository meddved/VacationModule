<?php
/**
 * Created by PhpStorm.
 * User: nebojsa.manojlovic
 * Date: 7/24/17
 * Time: 00:22
 */

namespace Repository;

use DbAdapter\DbAdapterInterface;
use Model\User;

class UserRepository implements UserRepositoryInterface
{
    const TABLE_NAME = 'users';
    const COLUMN_NAME_ID = 'id';

    /**
     * @var DbAdapterInterface
     */
    private $connection;

    public function __construct(DbAdapterInterface $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @param int $id
     * @return User
     */
    public function findById($id)
    {
        return $this->connection->findBy(UserRepository::COLUMN_NAME_ID, $id, UserRepository::TABLE_NAME, User::class);
    }

    /**
     * @return User[]
     */
    public function findAll()
    {
        return $this->connection->findAll(UserRepository::TABLE_NAME, User::class);
    }

    /**
     * @param string $username
     * @return User
     */
    public function findByUsername($username)
    {
        // TODO: Implement findByUsername() method.
    }
}