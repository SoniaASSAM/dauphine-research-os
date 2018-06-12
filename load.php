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
    	<link rel="stylesheet" href="style.css">
    	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.css">
	</head>
	<body>
		<div class="boutons">

			
		</div>
		<div>
		    <ul>
		        <li><a class="active" href="index.php">Home</a></li>
		        <li><a href="load.php">Chargements d'artciles </a></li>
		        <li><a href="search.php">Rechercher un article</a></li>
		        <li><a href="add_article.php">Publication d'articles</a></li>

		    </ul>

		</div>

<div class="container-index100" style=" background-image: url('images/bg-01.jpg'); " >

    <img src="images/logo.png" class="logo">
    <h1> Dauphine Research Academy</h1>
    <a href="index.html"><button class="DeconnexionB"> Déconnexion </button></a>

</div>
		<div class="wrap-login100 p-l-55 p-r-55 p-t-80 p-b-30 ">
			<form action="import.php" method="post">
				<input type="file" name="xmlFile" accept="text/xml">
				<input type="submit" name="submit" value="Charger fichier">
			</form>
		</div>
		
	</body>
</html>