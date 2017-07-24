<?php
/**
 * Created by PhpStorm.
 * User: nebojsa.manojlovic
 * Date: 7/23/17
 * Time: 18:53
 */

namespace DbAdapter;

use Model\ModelInterface;
use mysqli;

/**
 * Class MySqlAdapter
 * @package DbAdapter
 */
class MySqlAdapter implements DbAdapterInterface
{
    const DB_CONFIG_LOCATION = '/../../config.ini';
    const HOST = 'localhost';
    const USERNAME = 'username';
    const PASSWORD = 'password';
    const DB_NAME = 'dbname';

    /**
     * @var mysqli
     */
    protected static $connection;

    /**
     * @return mixed
     */
    public function connect()
    {
        if (!isset(self::$connection)) {
            $config = parse_ini_file(__DIR__ . MySqlAdapter::DB_CONFIG_LOCATION);

            self::$connection = new mysqli(
                MySqlAdapter::HOST,
                $config[MySqlAdapter::USERNAME],
                $config[MySqlAdapter::PASSWORD], // set this to null if db user does not have a password set
                $config[MySqlAdapter::DB_NAME]
            );
        }

        if (self::$connection === false) {
            // TODO: handle connection error
            return false;
        }

        return self::$connection;
    }

    /**
     * @inheritdoc
     */
    public function query($query)
    {
        $connection = $this->connect();

        $result = $connection->query($query);

        return $result;
    }

    /**
     * @inheritdoc
     */
    public function save($tableName, $columnNames, $values)
    {
        $query = "INSERT INTO $tableName ($columnNames) VALUES ($values)";

        $result = $this->query($query);

        if ($result) {
            return self::$connection->insert_id;
        }

        return $result;
    }

    /**
     * @inheritdoc
     */
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
    public function remove(ModelInterface $model, $tableName)
    {
        $query = 'DELETE FROM ' . $tableName . ' WHERE id = ' . $model->getId();

        $result = $this->query($query);

        return $result;
    }

    /**
     * @inheritdoc
     */
    public function select($query)
    {
        $rows = [];
        $result = $this->query($query);

        if (!$result) {
            return $result;
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
        $query = 'SELECT * FROM ' . $tableName;

        $rows = $this->select($query);

        $models = [];
        foreach ($rows as $row) {
            $model = new $model();
            $models[] = $model->mapResult($row);
        }

        return $models;
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

    /**
     * @inheritdoc
     */
    public function error()
    {
        // TODO: Implement error() method.
        // TODO: this method should handle DB errors
    }

    /**
     * @inheritdoc
     */
    public function escape($value)
    {
        // TODO: Implement escape() method.
        // TODO: this method should escape and caption SQL string before sendind it to DB
    }
}
