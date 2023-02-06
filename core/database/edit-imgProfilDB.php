<?php
if (!session_id()) {
  session_start();
}

require_once __DIR__ . './bdd.php';

$target_dir = __DIR__ . "..\..\..\public\images\uploads\ ";
$target_dir = trim($target_dir);

$_FILES['target_dir'] = $target_dir;

if (isset($_FILES['imageToUpload'])) {
  $target_file = $target_dir . basename($_FILES['imageToUpload']['name']);
  $uploadCheck = 1;
  $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
}

if (isset($_POST['submit'])) {

  $status = [
    'status' => ""
  ];

  if (!empty($_FILES['file'])) {
    $check = getimagesize($_FILES['imageToUpload']["tmp_name"]);

    if ($check !== false) {
      $status['status'] = "Fichier est une image - " . $check['mime'] . ".";
      $uploadCheck = 1;
    } else {
      $status['status'] = "Fichier invalide !";
      $uploadCheck = 0;
    }

    if ($_FILES["imageToUpload"]["size"] > 5000000) {
      $status['status'] = "Sorry, your file is too large.";
      $uploadCheck = 0;
    }

    if (
      $imageFileType != "jpg" && $imageFileType != "png" &&
      $imageFileType != "jpeg"
      && $imageFileType != "gif"
    ) {
      $status['status'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $uploadCheck = 0;
    }
  }

  if (file_exists($target_file)) {
    $status['exist'] = "Sorry, file already exists. <br>";
    $uploadCheck = 0;
  }

  if ($uploadCheck == 0) {
    $status['status'] = "Sorry, your file was not uploaded.";
  } else {
    if (move_uploaded_file(
      $_FILES["imageToUpload"]["tmp_name"],
      $target_file
    )) {
      $status['status'] = "The file " . htmlspecialchars(basename(
        $_FILES["imageToUpload"]["name"]
      )) . " has been uploaded.";

      try {
        $fileName = $_FILES['imageToUpload']['name'];
        $dateUpload =  date('Y-m-d H:m:s');
        $idUsers = $_SESSION['idUser'];
        $insertImageBdd->execute();
        header('location: ./index.php');

      } catch (Exception $e) {
        throw new Exception("Erreur :" . $e);
      }
    } else {
      $status['status'] = "Sorry, there was an error uploading your file.";
    }
  }
}



