<?php
if (!session_id()) {
  session_start();
}

require_once __DIR__ . './bdd.php';

const ERROR_EMPTY_INPUT = "Champ vide";
const ERROR_INVALID_INPUT = "Pas assez de caractères";
const ERROR_PWD = "Erreur de mot de passe";

$errors = [
  'pseudo' => '',
  'password' => '',
  'confirmPass' => '',
  'email' => ''
];

if ($_SERVER['REQUEST_METHOD'] === "POST") {

  if (isset($_POST['register'])) {
    header('location: ./inscription.php');
  }

  $input = filter_input_array(INPUT_POST, [
    'pseudo' => FILTER_SANITIZE_SPECIAL_CHARS,
    'password' => FILTER_SANITIZE_SPECIAL_CHARS,
    'email' => FILTER_SANITIZE_EMAIL
  ]);

  $pseudo = $input['pseudo'] ?? '';
  $password = $input['password'] ?? '';
  $email = $input['email'] ?? '';

  if (empty($pseudo)) {
    $errors['pseudo'] = ERROR_EMPTY_INPUT;
  } else if (strlen($pseudo) <= 2) {
    $errors['pseudo'] = ERROR_INVALID_INPUT;
  }

  if (empty($password)) {
    $errors['password'] = ERROR_EMPTY_INPUT;
  } else if (strlen($password) <= 2) {
    $errors['password'] = ERROR_INVALID_INPUT;
  }

  if (empty($email)) {
    $errors['email'] = ERROR_EMPTY_INPUT;
  } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = "Invalid email ";
  }

  if (empty(array_filter($errors, function ($e) {
    return $e !== '';
  }))) {
    try {
      $_SESSION['pseudo']  = $pseudoCheck = $_POST['pseudo'];
      $passwordCheck = $_POST['password'];
      $_SESSION['email'] = $emailCheck = $_POST['email'];
      $loginCheck->execute();
      $connection = $loginCheck->fetch();

      if ($connection == true) {
        if (password_verify($passwordCheck, $connection['password'])) {
          $idUsers = $_SESSION['idUser'] = $connection['id'] ?? '';

          header('location: ./index.php');
        } else {
          return $invalidUser = "Erreur de Pseudo / Mot de passe / Email ...";
        }
      } else {
        return $invalidUser = "Erreur de Pseudo / Mot de passe / Email ...";
      }
    } catch (Exception $e) {
      throw new Exception($e->getMessage());
    }
  }
}

