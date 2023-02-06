<?php
if (!session_id()) {
	session_start();
}

require_once __DIR__ . './core/database/bdd.php';
require_once __DIR__ . './core/database/registerDB.php';
include_once __DIR__ . './public/common/head.php';

if (isset($_SESSION['pseudo']) && isset($_SESSION['email']) && isset($_SESSION['idUser'])) {
  echo "Vous êtes déjà inscrit !";
  echo "<a href='./index.php'>Page d'accueil</a>";
  die();
}

?>


<title><?= $title  = 'Page d\'inscription'; ?></title>

<?php include_once __DIR__ . './public/common/header.php'; ?>

<body>
  <div>
    <h1>Page d'inscription</h1>
  </div>

  <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" id="register">
    <div>
      <label for="pseudo">Pseudo :</label>
      <input type="text" name="pseudo" id="pseudo" value="<?= $pseudo ?? ''; ?>" placeholder="Pseudo...">
    </div>
    <p class="errorsMsg"><?= $errors['pseudo'] ?? ''; ?></p>

    <div>
      <label for="password">Mot de passe :</label>
      <input type="text" name="password" id="password" placeholder="Mot de passe...">
    </div>
    <p class="errorsMsg"><?= $errors['password'] ?? ''; ?></p>
    <div>
      <label for="confirmPass">Confirmez votre mot de passe :</label>
      <input type="text" name="confirmPass" id="confirmPass" placeholder="Confirmez mot de passe...">
    </div>
    <p class="errorsMsg"><?= $errors['confirmPass'] ?? ''; ?></p>
    <div>
      <label for="email">Email :</label>
      <input type="text" name="email" id="email" value="<?= $email ?? ''; ?>" placeholder="Email...">
    </div>
    <p class="errorsMsg"><?= $errors['email'] ?? ''; ?></p>
    <p class="errorsMsg"><?= $errors['failed'] ?? ''; ?></p>
    <div>
      <input type="submit" name="submit" value="S'inscrire">
      <input type="submit" name="login" value="Se connecter">
    </div>

  </form>
</body>