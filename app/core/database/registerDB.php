<?php

const ERROR_EMPTY_INPUT = "Champ vide";
const ERROR_INVALID_INPUT = "Pas assez de caractères";
const EROOR_PWD_INPUT = "Vos mots de passe sont différents";

$errors = [
  'pseudo' => '',
  'password' => '',
  'confirmPass' => '',
  'email' => '',
  'failed' => ''
];

if ($_SERVER['REQUEST_METHOD'] === "POST") {
  if (isset($_POST['login'])) {
    header('location: ./connexion.php');
  }

  $input = filter_input_array(INPUT_POST, [
    'pseudo' => FILTER_SANITIZE_SPECIAL_CHARS,
    'password' => FILTER_SANITIZE_SPECIAL_CHARS,
    'confirmPass' => FILTER_SANITIZE_SPECIAL_CHARS,
    'email' => FILTER_SANITIZE_EMAIL
  ]);

  $pseudo = $input['pseudo'] ?? '';
  $password = $input['password'] ?? '';
  $confirmPass = $input['confirmPass'] ?? '';
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

  if (empty($confirmPass)) {
    $errors['confirmPass'] = ERROR_EMPTY_INPUT;
  } else if (strlen($confirmPass) <= 2) {
    $errors['confirmPass'] = ERROR_INVALID_INPUT;
  } else if ($confirmPass !== $password) {
    $errors['confirmPass'] = EROOR_PWD_INPUT;
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
      $password = password_hash($password, PASSWORD_BCRYPT);

      $checkPseudo = $_POST['pseudo'];
      $checkEmail = $_POST['email'];

      $checkIfUserExist->execute();
      $startCheck = $checkIfUserExist->fetch();

      if (
        !empty($startCheck['email']) == $checkEmail
        && !empty($startCheck['pseudo'] == $checkPseudo)
      ) {
        $errors['failed'] = "Le pseudo ou Email existe déjà !";
      } else {
        $insertNewUser->execute();
        header('location: ./connexion.php');
      }
    } catch (Exception $e) {
      throw new Exception($e->getMessage());
    }
  }
}
