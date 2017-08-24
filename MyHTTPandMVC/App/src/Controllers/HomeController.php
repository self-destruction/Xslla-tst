<?php

namespace App\Controllers;

use App\Models\Model;

class HomeController
{
    private $pdo;
    private $model;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
        if ($pdo == null)
            die('Соединение с базой данных отсутствует.');
        $this->model = new Model($pdo);
        $this->model->load();
    }

    public function getAll()
    {
        return json_encode($this->model->getRows());
    }

    public function getByOffset($offset)
    {
        return json_encode($this->model->getRow($offset));
    }

    public function post($body)
    {
        $decodedData = json_decode($body, true);
        if (!isset($decodedData['name']) || !isset($decodedData['cash'])) {
            return json_encode(-1);
        }
        $row = [
            'name' => $decodedData['name'],
            'cash' => intval($decodedData['cash'])
        ];
        $offset = $this->model->addRow($row);
        return json_encode($offset);
    }

    public function updateByOffset($offset, $body)
    {
        $decodedData = json_decode($body, true);
        if (!isset($decodedData['name']) || !isset($decodedData['cash'])) {
            return json_encode(-1);
        }
        $row = [
            'name' => $decodedData['name'],
            'cash' => intval($decodedData['cash'])
        ];
        return json_encode($this->model->updateRow($offset, $row));
    }

    public function deleteByOffset($offset)
    {
        return json_encode($this->model->deleteRow($offset));
    }
}