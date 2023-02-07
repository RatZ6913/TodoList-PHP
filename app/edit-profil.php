<?php
if (!session_id()) {
	session_start();
}

require_once __DIR__ . './core/database/edit-imgProfilDB.php';
require_once __DIR__ . './core/database/edit-profilDB.php';
include_once __DIR__ . './public/common/head.php';

if (!empty($_COOKIE['Card'])) {
	$cardVisa = $_COOKIE['Card'];
}
?>

<title><?= $title  = 'Page de connexion'; ?></title>

<?php include_once __DIR__ . './public/common/header.php'; ?>

<body>
	<div>
		<h1>Modifier votre profil</h1>
	</div>

	<section class="box-profil">
		<form action="./edit-profil.php" method="POST" enctype="multipart/form-data" id="profil-image">

			<img src="./public/images/<?= !empty($_SESSION['imageProfil']) ? "uploads/" . $_SESSION['imageProfil'] : "imports/profil-0.jpg"; ?>" alt="" id="img-profil">

			<p id="nameImage"><?= $_FILES['imageToUpload']['name'] ?? ''; ?></p>
			<p style="text-align:center">
				<?php echo $status['status'] ?? '';
				echo $status['exist'] ?? '' ?>;
			</p>
			<input type="file" name="imageToUpload">
			<input type="submit" name="submit" value="Upload">
		</form>

		<div class="box-editProfil">
			<form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
				<div>
					<label for="pseudo">Pseudo : </label>
					<input type="text" name="pseudo" id="pseudo" value="<?= $_SESSION['pseudo'] ?? ''; ?>" placeholder="Pseudo...">
				</div>
				<p class="errorsMsg"><?= $errors['pseudo'] ?? ''; ?></p>
				<div>
					<label for="password">Password :</label>
					<input type="text" name="password" id="password" value="" placeholder="Mot de passe...">
				</div>
				<p class="errorsMsg"><?= $errors['password'] ?? ''; ?></p>
				<div>
					<label for="email">Email :</label>
					<input type="text" name="email" id="email" value="<?= $_SESSION['email'] ?? ''; ?>" placeholder="Email...">
				</div>
				<p class="errorsMsg"><?= $errors['email'] ?? ''; ?></p>
				<div>
					<label for="card">Numéro CB :</label>
					<input type="text" name="card" id="card" value="<?= $cardVisa ?? ''; ?>" placeholder="VISA...">
				</div>
				<p class="errorsMsg"><?= $errors['card'] ?? ''; ?></p>
				<div>
					<input type="submit" value="Modifier">
				</div>
			</form>
		</div>
	</section>

</body>