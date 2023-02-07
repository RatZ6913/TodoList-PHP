<?php
if (!session_id()) {
	session_start();
}

if (!empty($_SESSION['pseudo']) && !empty($_SESSION['email']) && !empty($_SESSION['idUser'])) {
	echo "Vous êtes déjà connecté !";
	echo "<a href='./index.php'>Page d'accueil</a>";
	die();
}

require_once __DIR__ . './core/database/loginDB.php';
include_once __DIR__ . './public/common/head.php';
?>

<title><?= $title  = 'Page de connexion'; ?></title>

<?php include_once __DIR__ . './public/common/header.php'; ?>

<body>
	<div>
		<h1>Page de connexion</h1>
	</div>

	<form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
		<div>
			<label for="pseudo">Pseudo :</label>
			<input type="text" name="pseudo" id="pseudo" value="<?= $pseudo ?? ''; ?>" placeholder="Pseudo...">
		</div>
		<p class="errorsMsg"><?= $errors['pseudo'] ?? ''; ?></p>

		<div>
			<label for="password">Mot de passe :</label>
			<input type="text" name="password" id="password" value="<?= $password ?? ''; ?>" placeholder="Mot de passe...">
		</div>
		<p class="errorsMsg"><?= $errors['password'] ?? ''; ?></p>
		<div>
			<label for="email">Email :</label>
			<input type="text" name="email" id="email" value="<?= $email ?? ''; ?>" placeholder="Email...">
		</div>
		<p class="errorsMsg"><?= $errors['email'] ?? ''; ?></p>
		<div>
			<input type="submit" name="submit" value="Se connecter">
			<input type="submit" name="register" value="S'inscrire">
		</div>
		<?= $invalidUser ?? ''; ?>
	</form>
</body>