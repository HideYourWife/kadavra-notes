<?php


namespace Migrations;


class Migrate
{
    public static function migrateAll()
    {
        $user = new UserMigration();
        $tasks = new TaskMigration();

        if (!$user->migrate() && !$tasks->migrate()) {
            throw new \App\Exceptions\InvalidMigrationException();
        }

        return true;
    }
}