<?php
if (!session_id()) {
  session_start();
}

const ERROR_INVALID_INPUT = "Pas assez de caractères...";
const ERROR_EMPTY_INPUT = "Champ vide";
const ERROR_MAIL = "Mail invalide";

$patternCard = '/^4[0-9]{12}(?:[0-9]{3})?$/';

$errors = [
  'pseudo' => '',
  'password' => '',
  'email' => '',
  'card' => ''
];

if ($_SERVER['REQUEST_METHOD'] === "POST") {

  if (isset($_POST['register'])) {
    header('location: ./inscription.php');
  }

  $input = filter_input_array(INPUT_POST, [
    'pseudo' => FILTER_SANITIZE_SPECIAL_CHARS,
    'password' => FILTER_SANITIZE_SPECIAL_CHARS,
    'email' => FILTER_SANITIZE_EMAIL,
    'card' => FILTER_SANITIZE_NUMBER_INT
  ]);

  $pseudo = $input['pseudo'] ?? '';
  $password = $input['password'] ?? '';
  $email = $input['email'] ?? '';
  $card = $input['card'] ?? '';

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

  if (empty($card)) {
    $errors['card'] = ERROR_EMPTY_INPUT;
  } else if (!preg_match($patternCard, $card)) {
    $errors['card'] =  "Veuillez rentrer 16 chiffres !";
  }

  if (empty(array_filter($errors, function ($e) {
    return $e !== '';
  }))) {

    $updatePseudo = $pseudo;
    $updatePass = $password;
    $updateEmail = $email;
    $idUsers = $_SESSION['idUser'];
    $updateProfil->execute();

    $cookieName = "Card";
    $cookieCard = $card;
    setcookie($cookieName, $cookieCard, time() + 60 * 10, "/");
    header('location: ./index.php');
  }
}
