<?php

class Dbh{
  private $host = DB_HOST;
  private $user = DB_USER;
  private $password = DB_PASS;
  private $dbname = DB_NAME;

  //Method
  protected function connect() {
    //Data source name
    $dsn = 'mysql:host='.$this->host.';dbname='.$this->dbname;
    //PDO connection
    $pdo = new PDO($dsn,$this->user,$this->password);
    //Defaut atrribute/ optional Parameter
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
  }


}
