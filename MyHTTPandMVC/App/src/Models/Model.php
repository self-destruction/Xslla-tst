<?php
namespace App\Models;

class Model implements IModel
{
    private $pdo;
    private $dataSet;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getHeaders()
    {
        return ['name', 'cash'];
    }

    public function countRows()
    {
        return count($this->dataSet);
    }

    public function getRow($offset)
    {
        if (!key_exists($offset, $this->dataSet))
            return false;
        return [
            'name' => $this->dataSet[$offset]['name'],
            'cash' => $this->dataSet[$offset]['cash']
        ];
    }

    public function getRows()
    {
        $rows = array();
        foreach ($this->dataSet as $row) {
            $rows[] = [
                'name' => $row['name'],
                'cash' => $row['cash']
            ];
        }
        return $rows;
    }

    public function updateRow($offset, array $row)
    {
        if (!key_exists($offset, $this->dataSet))
            return false;
        if (!isset($row['name']) || !isset($row['cash']))
            return false;
        $id = $this->dataSet[$offset]['id'];
        $name = $row['name'];
        $cash = $row['cash'];
        $this->dataSet[$offset]['name'] = $name;
        $this->dataSet[$offset]['cash'] = $cash;
        $query = "UPDATE Users SET name=:n, cash=:c WHERE id=:i";
        $q = $this->pdo->prepare($query);
        $q->bindParam(':i', $id, \PDO::PARAM_INT);
        $q->bindParam(':n', $name, \PDO::PARAM_STR);
        $q->bindParam(':c', $cash, \PDO::PARAM_INT);
        $q->execute();
        return true;
    }

    public function addRow(array $row)
    {
        print($row['name']." ".$row['cash']."\n");

        $this->dataSet[] = $row;
        $name = $row['name'];
        $cash = $row['cash'];
        $query = "INSERT INTO Users (id, name, cash) VALUES (NULL, :n, :c)";
        $q = $this->pdo->prepare($query);
        $q->bindParam(':n', $name, \PDO::PARAM_STR);
        $q->bindParam(':c', $cash, \PDO::PARAM_INT);
        $q->execute();
        $this->dataSet[$this > $this->countRows()-1]['id'] = $this->pdo->lastInsertId();
        return count($this->dataSet);
    }

    public function deleteRow($offset)
    {
        if (!key_exists($offset, $this->dataSet)) {
            return false;
        }
        $id = $this->dataSet[$offset]['id'];
        array_splice($this->dataSet, $offset);
        $this->pdo->query("DELETE FROM Users WHERE id=$id");
        return true;
    }

    public function load()
    {
        $this->dataSet = $this->pdo->query('SELECT * FROM Users')->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function save()
    {

    }
}