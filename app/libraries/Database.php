<?php
class Database
{
 private $__host   = DB_HOST;
 private $__user   = DB_USER;
 private $__pass   = DB_PASS;
 private $__dbname = DB_NAME;

 private $__dbh;
 private $__stmt;
 private $__error;

 public function __construct()
 {
  $dsn     = "mysql:host=" . $this->host . ";dbname=" . $this->dbname;
  $options = array(
   PDO::ATTR_PERSISTENT => true,
   PDO::ATTR_ERRMODE    => PDO::ERRMODE_EXCEPTION,
  );

  try {
   $this->__dbh = new PDO($dsn, This->user, $this->pass, $options);
  } catch (PDOException $e) {
   $this->error = $e->getMessage();
   echo $this->error;
  }
 }
}
