<?php

class Auth extends Database
{
    public $link;

    public function __construct()
    {
        $this->link = $this->connect();
    }


    public function getConnect()
    {
        return $this->connect();
    }

    public function addUser($username, $password)
    {
        $query = $this->link->prepare("INSERT INTO users (`username`, `password`) VALUES (?,?)");
        $query->execute([$username, $password]);
        return $query->rowCount();
    }

    public function loginUser($username, $password)
    {
        $query = $this->link->prepare("SELECT * FROM users WHERE `username`= ? AND `password`= ? ");
        $query->execute([$username, $password]);
        return $query->rowCount();

        //return $this->link;
    }

    public function getInfo($username)
    {
        $query = $this->link->query("SELECT * FROM users WHERE `username`='$username'");
        return $query;
    }
}