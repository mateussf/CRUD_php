<?php

namespace App\models;

use App\db\Database;
use PDO;

class Model {
    protected $pdo;
    protected $table;
    protected $primaryKey;
    protected $fieldsTable;
    protected $fields;

    protected $query;
    protected $params = [];

    public function __construct() {
        $this->pdo = Database::connect();
    }

    public function find($codigo) {
        $stmt = $this->pdo->prepare("SELECT ".implode(',', array_keys($this->fields))." FROM $this->table WHERE $this->primaryKey = ?");
        $stmt->execute([$codigo]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function first() {
        $this->query .= " LIMIT 1";
        $stmt = $this->pdo->prepare($this->query);
        $stmt->execute($this->params);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function where($column, $value) {
        $this->query = "SELECT * FROM $this->table WHERE $column = :value";
        $this->params = [':value' => $value];
        return $this;
    }

    public function get() {
        $stmt = $this->pdo->prepare($this->query);
        $stmt->execute($this->params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create() {

        $columns = implode(', ', array_keys($this->fields));
        $placeholders = implode(', ', array_fill(0, count($this->fields), '?'));
        $values = array_values($this->fields);

        $stmt = $this->pdo->prepare("INSERT INTO $this->table ($columns) VALUES ($placeholders)");
        $stmt->execute($values);

        $primaryKey = $this->pdo->lastInsertId();
        $this->fields[$this->primaryKey] = $primaryKey ? $primaryKey : null;
        return $this;
    }

    public function update(array $fields, $codigo) {
        $valuesToUpdate = implode(', ', array_map(function ($value, $key) {
            return "$key = " . (is_numeric($value) ? $value : "'" . addslashes($value) . "'");
        }, $fields, array_keys($fields)));
        $stmt = $this->pdo->prepare("UPDATE $this->table SET $valuesToUpdate WHERE $this->primaryKey = ?");
        return $stmt->execute([$codigo]);
    }

    public function delete($param1, $param2 = "") {
        if ($param2 !== ""){
            $campo = $param1;
            $codigo = $param2;
        }else{
            $campo = $this->primaryKey;
            $codigo = $param1;
        }

        $stmt = $this->pdo->prepare("DELETE FROM $this->table WHERE $campo = ?");
        return $stmt->execute([$codigo]);
    }

    public static function all() {
        $pdo = Database::connect();
        $table = (new static())->table;
        $stmt = $pdo->prepare("SELECT * FROM $table");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function save()
    {
        if ($this->fields[$this->primaryKey]) {
            return $this->update($this->fields, $this->fields[$this->primaryKey]);
        }else{
            return $this->create();
        }
    }
}