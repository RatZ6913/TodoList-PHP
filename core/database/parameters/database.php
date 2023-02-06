<?php

const DB_HOST = "127.0.0.1";
const DB_PORT = "3306";
const DB_DATABASE = "exercice_cours";
// const DB_NAME = "root"; // Greta
// const DB_PWD = ""; // Greta
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
  // echo "Réussi";
} catch (PDOException $e) {
  throw new Exception($e->getMessage());
}

return $pdo;



// cd '270.1.23 TP 2'
// DB_NAME='' DB_PWD='' php -S localhost:3000 