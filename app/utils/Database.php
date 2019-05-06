<?php

namespace app\utils;

class Database {

    public static $instance = null;


    public static function getInstance() {
      $host = '127.0.0.1';
      $db   = 'civ';
      $user = 'civ';
      $pass = 'civ';
      $charset = 'utf8';
      $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
      $opt = [
          \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
          \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
          \PDO::ATTR_EMULATE_PREPARES   => false,
      ];
      if(!self::$instance) {
        try {
            self::$instance = new \PDO($dsn, $user, $pass, $opt);
        }
        catch (PDOException $e) {
            errorHandler(0, $e->getMessage(), $e->getFile(), $e->getLine(), print_r($e, true), 'sql');
            die('SQL Error, terminating script.');
        }
      }
      return self::$instance;
    }

}
