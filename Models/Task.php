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


    public function update(array $data)
    {

        $stmp = $this->db->execute("UPDATE $this->tableName SET `text`= ?, `resolved`=?, `updated_at`=? WHERE id=?",
            array($data['text'], $data['resolved'], $data['updated_at'], $data['id']));
        return $stmp;
    }


    /**
     * @param integer $pageNum current page
     * @param string $order_by sort by
     * @param string $modifier sort modifier
     * @return array
     * */

    public function pagen($pageNum = 0, $order_by = 'id', $modifier = 'ASC')
    {
        $start = 0;
        $per_page = PAGINATION;
        $page_counter = 0;


        if ($pageNum != 0) {
            $page_counter = $pageNum;
            $start = $pageNum * $per_page;
        }

        $q = "SELECT * FROM $this->tableName ORDER BY $order_by $modifier LIMIT $start, $per_page";
        $result = $this->db->execute($q);

        return $result;
    }
}