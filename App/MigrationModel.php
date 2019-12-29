<?php


namespace App;


abstract class MigrationModel
{
    protected $db;


    function __construct()
    {
        $this->db = new Db();
    }


    protected function tableExists($table) {

        try {
            $result = $this->db->query("SELECT 1 FROM $table LIMIT 1");
        } catch (Exception $e) {
            return FALSE;
        }

        // Result is either boolean FALSE (no table found) or PDOStatement Object (table found)
        return $result !== FALSE;
    }
}