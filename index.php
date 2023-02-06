<?php
session_start();

require_once __DIR__ . './core/database/parameters/database.php';
require_once __DIR__ . './core/database/bdd.php';
include_once __DIR__ . './public/common/head.php';

if (empty($_SESSION['pseudo']) && empty($_SESSION['email']) && empty($_SESSION['idUser'])) {
  header('location: ./connexion.php');
  echo "Veuillez vous connecter";
} else {
  $pseudoSess = $_SESSION['pseudo'];
  $emailSess = $_SESSION['email'];
  $idUsers = $_SESSION['idUser'];

  $getImage->execute();
  $showImage = $getImage->fetch();

  $_SESSION['imageProfil'] = $showImage['file_name'] ?? '';
}

?>

<title><?= $title  = 'Page de connexion'; ?></title>
<?php include_once __DIR__ . './public/common/header.php'; ?>

<body>
  <div>
    <h1>Page d'accueil</h1>
  </div>

  <section>
    <h3>Bravo <span class="pseudo"><?= $pseudoSess; ?></span> ! Vous savez utiliser un formulaire.</h3>
    <h3>Votre email est : <span class="email"><?= $emailSess; ?></span> !</h3>
  </section>

  <section id="box-todo">
    <div id="content-todo">
      <h4>Listes de Tâches</h4>
    </div>
    <div id="tasks">
      <?php require_once __DIR__ . './core/database/tasksDB.php'; ?>
      <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="form-task">
        <input type="text" name="task" id="task">
        <input type="submit" name="add-tasks" value="Ajouter" class="btn-task">
      </form>
    </div>
  </section>

  <section id="task-lists">
    <?php
    foreach ($showTasks as $key) {
      $edit = "Modifier";
      $disabled = "disabled";
      if (!empty($_POST['id=' . $key['idtasks']] ?? '' === $key['idtasks'])) {
        $edit = "Valider";
        $disabled = "";

        $editText = $_POST[$idUsers] ?? $key['text'];
        $idTasks = $key['idtasks'];
        $updateText = $editTasks->execute();

        if (!empty($_POST[$idUsers])) {
          header('location: ./');
        }
      }
    ?>
      <div class="taskAdded">
        <div>
          <h4 class="count"><?= $count++; ?></h4>
          <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="form-task" method="POST">
            <input type="text" class="text-tasks" value="<?= $key['text']; ?>" name="<?= $_POST['text'] = $idUsers; ?>" <?= $disabled ?? ''; ?>>
            <input type="submit" value="<?= $edit ?? ''; ?>" name="id=<?= $key['idtasks']; ?>">
            <input type="submit" value="Supprimer" name="id=<?= $key['idtasks']; ?>">
          </form>
        </div>
      </div>
    <?php
      if (!empty($_POST['id=' . $key['idtasks']] ?? '' === $key['idtasks'])) { 
        
        if ($_POST['id=' . $key['idtasks']] == 'Supprimer') {
          $delTasks->execute();
          header('location: ./');
        }
      }
    }
    ?>
  </section>
</body>