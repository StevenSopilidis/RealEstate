<?php

//class that returns the database connection
class Dbh{
    private $host = 'localhost';
    private $username = 'root';
    private $pass = '';
    private $dbName = 'realestate';

    protected function connect(){
        $host = $this->host;
        $dbName = $this->dbName;
        $pdo = new PDO("mysql:host=$host;dbname=$dbName",$this->username,$this->pass);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;
    }
}