<?php


namespace Migrations;


use App\MigrationModel;

class UserMigration extends MigrationModel
{
    public function migrate()
    {
        if (!$this->tableExists('users')) {
            return $this->db->query(
                'CREATE TABLE users (
                        id int not null auto_increment,
                        name varchar(255) not null,
                        email varchar(255) not null unique,
                        password varchar(255) not null,
                        primary key (id))'
            );
        }
    }
}