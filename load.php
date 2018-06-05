<?php
	session_start();
	if (!isset($_SESSION['loggedIn']) || !$_SESSION["loggedIn"]) {
		header("Location : index.php");
		exit();
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Chargement d'articles</title>
		<link rel="stylesheet" href="projet.css" />
		<div class="boutons">

			<?php
				echo "<ul><li>Hello ".$_SESSION["firstname"]." ".$_SESSION['familyname']."</li></ul>";
				echo "\n<li><a href='add_article.php'>Nouvel article</a></li>";
				echo "\n<li><a href='logout.php'>Deconnexion</a></li>";
				echo "\n<li><a href='load.php'>Chargement d'articles</a></li><ul>";
			?>
		</div>
	</head>
	<body>
		<form action="import.php" method="post">
			<input type="file" name="xmlFile" accept="text/xml">
			<input type="submit" name="submit" value="Charger fichier">
		</form>
	</body>
</html>