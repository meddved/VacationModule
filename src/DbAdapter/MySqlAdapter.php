<?php
/**
 * Created by PhpStorm.
 * User: nebojsa.manojlovic
 * Date: 7/23/17
 * Time: 18:53
 */

namespace DbAdapter;

use mysqli;

class MySqlAdapter implements DbAdapterInterface
{
    const DB_CONFIG_LOCATION = '/../../config.ini';
    const HOST = 'localhost';
    const USERNAME = 'username';
    const PASSWORD = 'password';
    const DB_NAME = 'dbname';

    protected static $connection;

    /**
     * @return mixed
     */
    public function connect()
    {
        if(!isset(self::$connection)) {
            $config = parse_ini_file(__DIR__ . MySqlAdapter::DB_CONFIG_LOCATION);

            self::$connection = new mysqli(
                MySqlAdapter::HOST,
                $config[MySqlAdapter::USERNAME],
                null,
                $config[MySqlAdapter::DB_NAME]
            );
        }

        if(self::$connection === false) {
            // TODO: handle connection error
            return false;
        }
        return self::$connection;
    }

    /**
     * @param string $query
     * @return mixed
     */
    public function query($query)
    {
        // Connect to the database
        $connection = $this->connect();

        // Query the database
        $result = $connection->query($query);

        return $result;
    }

    /**
     * @return mixed
     */
    public function error()
    {
        // TODO: Implement error() method.
    }

    /**
     * @return mixed
     */
    public function escape($value)
    {
        // TODO: Implement escape() method.
    }

    /**
     * @inheritdoc
     */
    public function save($model, $tableName, $columnNames, $values)
    {
        $query = "INSERT INTO $tableName ($columnNames) VALUES ($values)";

        $result = $this->query($query);

        if ($result) {
            return self::$connection->insert_id;
        }

        return $result;
    }

    public function update($tableName, array $columns)
    {
        $query = 'UPDATE ' . $tableName . ' SET ';

        $i = 0;
        foreach ($columns as $columnName => $columnValue) {
            $query .= $columnName . ' = ' . $columnValue;
            $i++;
            if ($i < count($columns)) {
                $query .= ', ';
            }

        }
        $query .= ' WHERE id = ' . $columns['id'];

        return $this->query($query);
    }

    /**
     * @inheritdoc
     */
    public function remove($model, $tableName)
    {
        // TODO: Implement remove() method.
    }

    /**
     * @inheritdoc
     */
    public function select($query)
    {
        $rows = array();
        $result = $this->query($query);
        if($result === false) {
            return false;
        }
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

    /**
     * @inheritdoc
     */
    public function findAll($tableName, $model)
    {
        // TODO: Implement findAll() method.
    }

    /**
     * @inheritdoc
     */
    public function findBy($columnName, $columnValue, $tableName, $model)
    {
        $query = 'SELECT *
        FROM ' . $tableName . '
        WHERE ' . $columnName . ' = ' . $columnValue;

        $results = $this->select($query);

        $result = new $model();
        $result->mapResult($results[0]);

        return $result;
    }
}