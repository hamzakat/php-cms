<?php

require_once 'database/MySQLConnection.php';

/**
 * This base class will be used to extend DAOs (Data Access Object) for data models
 * 
 */

abstract class BaseDAO
{
    // required for establishing db connection
    private $db;
    protected $pdo;

    // required for data mapping (db row to object)
    private $reflection;

    // will be implmented based on model 
    abstract protected function getModelClass();
    abstract protected function getModelTable();

    abstract public function add($object);
    abstract public function getAll($arg);
    abstract public function getById($id);


    function __construct()
    {
        $this->db = new MySQLConnection(DB_HOST, DB_PORT, DB_NAME, DB_USER, DB_PASSWORD);
        $this->pdo = $this->db->getPDO();

        // will be used for data mapping
        $this->reflection = new ReflectionClass($this->getModelClass());
    }

    protected function getFields()
    {
        $properties = $this->reflection->getProperties(ReflectionProperty::IS_PRIVATE);
        $fields = [];
        foreach ($properties as $prop) {
            array_push($fields, $prop->getName());
        }
        return $fields;
    }

    /* Mapping DB row to object */
    protected function mapToObject($row)
    {
        $fields = $this->getFields();
        $properties = array();
        foreach ($fields as $field) {
            $properties[$field] = $row[$field];
        }
        return $this->reflection->newInstanceArgs($properties);
    }

    protected function getIdField()
    {
        return "id";
    }
}
