<?php

namespace App\Models;


interface IModel
{
    /**
     * @return array
     */
    public function getHeaders();

    /**
     * @return void
     */
    public function load();

    /**
     * @return void
     */
    public function save();

    /**
     * @param array $row
     * @return int offset
     */
    public function addRow(array $row);

    /**
     * @param int $offset
     * @param array $row
     * @return boolean
     */
    public function updateRow($offset, array $row);

    /**
     * @param int $offset
     * @return array|null
     */
    public function getRow($offset);

    /**
     * @param $offset integer
     * @return boolean
     */
    public function deleteRow($offset);

    /**
     * @return array
     */
    public function getRows();

    /**
     * @return int
     */
    public function countRows();

}