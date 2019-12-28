<?php


namespace App;

use App;
use PDO;

class Db
{

    public $pdo;


    public function __construct()
    {
        $settings = $this->getPDOSettings();
        $this->pdo = new PDO($settings['dsn'], $settings['user'], $settings['pass'], $settings['opt']);
    }


    protected function getPDOSettings()
    {
        $config = include ROOTPATH.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'db.php';
        $result['dsn'] = "{$config['type']}:host={$config['host']};dbname={$config['dbname']};charset={$config['charset']}";
        $result['user'] = $config['user'];
        $result['pass'] = $config['pass'];

        $result['opt'] = [
//            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        return $result;
    }


    public function execute($query, array $params=null)
    {
        if(is_null($params)){
            $stmt = $this->pdo->query($query);
            return $stmt->fetchAll();
        }
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($params);

        return $stmt->fetchAll();
    }


    public function query($query)
    {
        $stmt = $this->pdo->query($query);

        return $stmt;
    }
}