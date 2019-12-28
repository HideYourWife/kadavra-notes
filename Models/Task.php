<?php


namespace Models;


use App\Model;

class Task extends Model
{
    public function create(array $data)
    {
        $stmp = $this->db->execute("INSERT INTO $this->tableName(name, email, text) VALUES(:name,:email,:text)", $data);
        return $stmp;
    }
}