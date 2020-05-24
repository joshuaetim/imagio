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


    public function loginUser($username, $password)
    {
        $query = $this->link->query("SELECT * FROM users WHERE `username`='$username' AND `password`='$password'");
        return $query->rowCount();

        //return $this->link;
    }

    public function getInfo($username)
    {
        $query = $this->link->query("SELECT * FROM users WHERE `username`='$username'");
        return $query;
    }
}