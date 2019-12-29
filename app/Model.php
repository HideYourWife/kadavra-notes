<?php


namespace App;
use App\Db;


abstract class Model
{
    protected $db;
    protected $tableName;

    /**
     * @param string $tableName tableName
     *
     */

    function __construct($tableName)
    {
        $this->db = new Db();
        $this->tableName = $tableName;
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


    public function getAll()
    {
        $stmp = $this->db->execute("SELECT * FROM $this->tableName");
        return $stmp;
    }


    public function getId($id=1)
    {
        $stmp = $this->db->execute("SELECT * FROM $this->tableName WHERE id = $id");
        return $stmp;
    }

    /**
     * @return integer row count
     */
    public function getCount()
    {
        $stmp = $this->db->execute("SELECT COUNT(id) FROM $this->tableName");
        $result = array_values(call_user_func_array('array_merge', $stmp));
        return $result[0];
    }

}