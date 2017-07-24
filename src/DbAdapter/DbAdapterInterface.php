<?php
/**
 * Created by PhpStorm.
 * User: nebojsa.manojlovic
 * Date: 7/23/17
 * Time: 18:17
 */

namespace DbAdapter;

use Model\ModelInterface;

interface DbAdapterInterface
{
    /**
     * @return mixed
     */
    public function connect();

    /**
     * @param string $query
     *
     * @return mixed
     */
    public function query($query);

    /**
     * @param string $columnName
     * @param mixed $columnValue
     * @param string $tableName
     * @param string $model
     *
     * @return mixed
     */
    public function findBy($columnName, $columnValue, $tableName, $model);

    /**
     * @param string $tableName
     * @param string $model
     *
     * @return mixed
     */
    public function findAll($tableName, $model);

    /**
     * @param string $tableName
     * @param string $columnNames
     * @param string $values
     *
     * @return mixed
     */
    public function save($tableName, $columnNames, $values);

    /**
     * @param string $tableName
     * @param array $columns
     *
     * @return mixed
     */
    public function update($tableName, array $columns);

    /**
     * @param ModelInterface $model
     * @param string $tableName
     *
     * @return mixed
     */
    public function remove(ModelInterface $model, $tableName);

    /**
     * @param $query
     * 
     * @return mixed
     */
    public function select($query);

    /**
     * @param string $value
     *
     * @return string
     */
    public function escape($value);

    /**
     * @return mixed
     */
    public function error();
}