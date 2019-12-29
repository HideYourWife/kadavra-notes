<?php


namespace Models;
use App\Model;


class User extends Model
{
    public function getName($name)
    {
        $stmp = $this->db->execute("SELECT * FROM $this->tableName WHERE name = ?", array($name));
        return $stmp;
    }
}