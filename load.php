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
	</head>
	<body>
		<form action="import.php" method="post">
			<input type="file" name="xmlFile" accept="text/xml">
			<input type="submit" name="submit" value="Charger fichier">
		</form>
	</body>
</html>