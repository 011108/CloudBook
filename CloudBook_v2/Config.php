<?php
//any space between thes makes error 
class DB{
  private $servername;
  private $username;
  private $password;
  private $dbname;
  
  public function connect(){
    $this->servername = 'localhost';
    $this->username = 'root';
    $this->password = '';
    $this->dbname   = 'CloudBook';
    
  
    try {
       $dsn = "mysql:host=". $this->servername."; dbname=".$this->dbname ;
       $pdo = new PDO($dsn, $this->username, $this->password );
       $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       return $pdo;
    } catch (PDOException $e ) {
       echo 'faild to Connect to the server';
    }
 
  }
}