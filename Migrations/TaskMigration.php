<?php


namespace Migrations;


use App\MigrationModel;

class TaskMigration extends MigrationModel
{
    public function migrate()
    {
        if (!$this->tableExists('tasks')) {
            return $this->db->query(
                'CREATE TABLE tasks (
                        id INT NOT NULL AUTO_INCREMENT,
                        name VARCHAR(255) NOT NULL,
                        email VARCHAR(255) NOT NULL,
                        text TEXT NOT NULL,
                        resolved TINYINT default NULL,
                        updated_at timestamp,
                        PRIMARY KEY (id))'
            );
        }
    }
}