<?php

namespace App\Models;

use App\Models\CrudInterface;
use App\Models\Database;
use PDO;
use Exception;
use App\Models\QueryBuilder;

abstract class BaseModel implements CrudInterface
{
    use QueryBuilder;


    private $_connection;

    protected $name = "BaseModel";
    private $_query;

    public function __construct()
    {
        $this->_connection = new Database();
    }

    abstract public function getAllWithPaginate(int $limit, int $offset);

    public function getAll()
    {
        $this->_query = "SELECT * FROM $this->tableName";

        return $this;
    }

    public function orderBy(string $order = 'ASC')
    {
        $this->_query = $this->_query . "order by " . $order;

        return $this;
    }


    public function get()
    {
        $stmt = $this->_connection->PDO()->prepare($this->_query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getOne($id)
    {
        return [];
    }


    public function limit(int $limit = 10)
    {
        $stmt   = $this->_connection->PDO()->prepare($this->_query);
        $result = $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update(int $id, array $data)
    {
    }
    public function remove(int $id): bool
    {
        return true;
    }

 

    public function insertData($table, $data)
    {

        if (!empty($data)) {
            
            $fielStr  = '';
            $valueStr = '';
            foreach ($data as $key => $value) {
                $fielStr .= $key . ',';
                $valueStr .= "'" . $value . "',";
            }

            $fielStr  = rtrim($fielStr, ',');
            $valueStr = rtrim($valueStr, ',');
            $sql      = "INSERT INTO  $table($fielStr) VALUES ($valueStr)";
         
            $status = $this->query($sql);
            if (!$status)
                return false;
        }
        return true;
    }

    public function updateData($table, $data, $condition = '')
    {
        if (!empty($data)) {
            $updateStr = '';
            foreach ($data as $key => $value) {
                if (strpos($value, ' ') !== false) {
                    $updateStr .= "$key='$value',";
                } else if ($value === '' || $value === null) {
                    $updateStr .= "$key=NULL,";
                } else {
                    $updateStr .= "$key='$value',";
                }
            }
            $updateStr = rtrim($updateStr, ',');
            $sql       = "UPDATE $table SET $updateStr";
            if (!empty($condition)) {
                $sql = "UPDATE $table SET $updateStr WHERE $condition";
            }
            $status = $this->query($sql);
            if (!$status)
                return false;
        }
        return true;
    }

    public function deleteData($table, $condition = ''): bool
    {
        $sql = 'DELETE FROM ' . $table;
        if (!empty($condition)) {
            $sql = 'DELETE FROM ' . $table . ' WHERE ' . $condition;
        }
        $status = $this->query($sql);
        if (!$status)
            return false;
        return true;
    }

    public function query($sql)
    {
        try {
            $statement = $this->_connection->PDO()->prepare($sql);
            $statement->execute();
            return $statement;
        } catch (Exception $ex) {
            $mess = $ex->getMessage();
            echo $mess;
            die();
        }
    }
}

