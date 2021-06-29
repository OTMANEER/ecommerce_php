<?php
class DatabaseClient {
  private static $instance = null;
  private $database;

  private $host = 'localhost';
  private $dbName = 'db';
  private $username = 'root';
  private $password = '';

  private function __construct()
  {
    $this->database = new PDO("mysql:host={$this->host};dbname={$this->dbName};charset=utf8",
      $this->username,
      $this->password,
      [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
  }

  public static function getDatabase() {
    if(is_null(self::$instance)) {
      self::$instance = new DatabaseClient();
    }
    return self::$instance->database;
  }
}
