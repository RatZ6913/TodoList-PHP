<?php

require_once __DIR__ . './bdd.php';

$getTasks->execute();
$showTasks = $getTasks->fetchAll();
$count = 1;

if ($_SERVER["REQUEST_METHOD"] === "POST") {

  if (!empty($_POST['add-tasks'])) {

    if (!empty($_POST['task'])) {
      $textTask = $_POST['task'];
      $addTasks->execute();
      header('location: ./index.php');
    }
  }
}
