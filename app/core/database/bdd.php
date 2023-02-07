<?php

require_once __DIR__ . './parameters/database.php';

$insertNewUser = $pdo->prepare("INSERT INTO users VALUES (DEFAULT, :pseudo, :password, :email)");
$insertNewUser->bindParam('pseudo', $pseudo);
$insertNewUser->bindParam('password', $password);
$insertNewUser->bindParam('email', $email);


$checkIfUserExist = $pdo->prepare("SELECT pseudo, email FROM users WHERE pseudo = :checkPseudo OR email = :checkEmail");
$checkIfUserExist->bindParam('checkPseudo', $checkPseudo);
$checkIfUserExist->bindParam('checkEmail', $checkEmail);


$loginCheck = $pdo->prepare("SELECT id, pseudo, password, email FROM users WHERE pseudo = :pseudo AND email = :email");
$loginCheck->bindParam('pseudo', $pseudoCheck);
$loginCheck->bindParam('email', $emailCheck);


$uploadImageProfil = $pdo->prepare("INSERT INTO images (file_name, uploaded_on) VALUES (':fileName', NOW())");
$uploadImageProfil->bindParam('fileName', $fileName);


$insertImageBdd = $pdo->prepare("INSERT INTO images (file_name, uploaded_on, idUsers)
VALUES (:fileName, :date, :idUsers)");
$insertImageBdd->bindParam('fileName', $fileName);
$insertImageBdd->bindParam('date', $dateUpload);
$insertImageBdd->bindParam('idUsers', $idUsers);


$getImage = $pdo->prepare("SELECT * FROM images WHERE idUsers = :idUsers ORDER BY uploaded_on DESC");
$getImage->bindParam('idUsers', $idUsers, PDO::PARAM_INT);


$updateProfil = $pdo->prepare("UPDATE users SET pseudo = :updatePseudo, password = :updatePass,
email = :updateEmail WHERE id = :idUsers");
$updateProfil->bindParam('updatePseudo', $updatePseudo);
$updateProfil->bindParam('updatePass', $updatePass);
$updateProfil->bindParam('updateEmail', $updateEmail);
$updateProfil->bindParam('idUsers', $idUsers);

// Partie : ToDo List
$addTasks = $pdo->prepare('INSERT INTO tasks(text, idUsers) VALUES (:text, :idUsers)');
$addTasks->bindParam('text', $textTask);
$addTasks->bindParam('idUsers', $idUsers);

$getTasks = $pdo->prepare("SELECT * FROM tasks WHERE idUsers = :idUsers ORDER BY idtasks DESC");
$getTasks->bindParam('idUsers', $idUsers);


$editTasks = $pdo->prepare("UPDATE tasks SET text = :textTask WHERE idtasks = :idTasks");
$editTasks->bindParam('textTask', $editText);
$editTasks->bindParam('idTasks', $idTasks);

$delTasks = $pdo->prepare("DELETE tasks FROM tasks WHERE idtasks = :idTasks");
$delTasks->bindParam('idTasks', $idTasks);
