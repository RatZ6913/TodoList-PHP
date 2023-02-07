<?php
if (!session_id()) {
	session_start();
}

require_once __DIR__ . './core/database/parameters/database.php';
require_once __DIR__ . './core/database/bdd.php';
include_once __DIR__ . './public/common/head.php';

if($_SERVER['REQUEST_METHOD'] === "POST"){
	session_destroy();
	header('location: ./index.php');
}

?>

<title><?= $title  = 'Page de connexion'; ?></title>

<?php include_once __DIR__ . './public/common/header.php'; ?>

<body>
	<div>
		<h1>Page de deconnexion</h1>
	</div>

	<form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
		<input type="submit" name="disconnect" value="Se déconnecter" id="disconnect">
	</form>
</body>