<?php

abstract class Database
{
    protected $db_name = 'image_editor';
    protected $db_user = 'root';
    protected $db_pass = 'joshua2020';
    protected $db_host = 'localhost';
    protected $charset = 'utf8mb4';
    protected $port = "3306";

    protected $options = [
        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
        \PDO::ATTR_EMULATE_PREPARES => false,
        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
    ];

    public $dsn = 'mysql:host=localhost;dbname=image_editor;charset=utf8mb4;port=3306';

    public function connect()
    {
        try {
            $pdo = new \PDO($this->dsn, $this->db_user, $this->db_pass, $this->options);
            return $pdo;
        }
        catch (\PDOException $e) {
            return 'Error: '.$e->getMessage();
        }
        catch(Exception $e){
            return 'fuck off';
        }
    }

}
