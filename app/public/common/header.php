<?php

require_once __DIR__ . '../../../core/database/bdd.php';

?>
<header>
  <nav>
    <div>
      <?php
      if (empty($_SESSION['imageProfil'])) {
      ?>
        <img src="./public/images/imports/profil-0.jpg" alt="" id="navProfil">
      <?php
      } else {
      ?>
        <img src="./public/images/uploads/<?= $_SESSION['imageProfil']; ?>" alt="" id="navProfil">
      <?php
      }
      ?>
      <a href="./edit-profil.php">Modifier votre profil</a>
    </div>
    <ul>
      <li><a href="./index.php">Accueil</a></li>
      <li><a href="./Inscription.php">Inscription</a></li>
      <li><a href="./connexion.php">Connexion</a></li>
      <li><a href="./deconnexion.php">Déconnexion</a></li>
    </ul>
  </nav>
</header>