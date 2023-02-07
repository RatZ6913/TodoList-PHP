<?php

const DB_HOST = "127.0.0.1";
const DB_PORT = "3306";
const DB_DATABASE = "exercice_cours";

try {
  $pdo = new PDO(
    'mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_DATABASE,
    getenv('DB_NAME'),
    getenv('DB_PWD'),
    [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8; USE exercice_cours'
    ]
  );
} catch (PDOException $e) {
  throw new Exception($e->getMessage());
}
return $pdo;

