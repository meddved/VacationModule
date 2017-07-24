<?php
/**
 * Created by PhpStorm.
 * User: nebojsa.manojlovic
 * Date: 7/23/17
 * Time: 18:17
 */

namespace DbAdapter;

interface DbAdapterInterface
{
    /**
     * @return mixed
     */
    public function connect();

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
     * @param string $model
     * @param string $tableName
     * @param string $columnNames
     * @param string $values
     *
     * @return mixed
     */
    public function save($model, $tableName, $columnNames, $values);

    /**
     * @param string $tableName
     * @param array $columns
     *
     * @return mixed
     */
    public function update($tableName, array $columns);

    /**
     * @param string $model
     * @param string $tableName
     *
     * @return mixed
     */
    public function remove($model, $tableName);

    /**
     * @param $query
     * 
     * @return mixed
     */
    public function select($query);
}