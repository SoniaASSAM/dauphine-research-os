<!DOCTYPE html>
<header>
	<head>
		<meta charset="utf-8" />
		<title>Dauphine Research Object System</title>
		<meta name="viewport" content="width=device-width"/>
		<link rel="stylesheet" href="projet.css" />
	</head>
	
	<div class="boutons">

			<?php
				session_start();
				if (isset($_SESSION['loggedIn']) && $_SESSION["loggedIn"]) {
					echo "<ul><li>Hello ".$_SESSION["firstname"]." ".$_SESSION['familyname']."</li></ul>";
					echo "\n<li><a href='add_article.php'>Nouvel article</a></li>";
					echo "\n<li><a href='logout.php'>Deconnexion</a></li>";
					echo "\n<li><a href='load.php'>Chargement d'articles</a></li><ul>";
				}
				else echo "<ul>
							<li><a href='login.php'>Connexion  |</a></li>
							<li><a href='signin.php'>Inscription</a></li>
						   </ul> ";
			?>
	</div>
	
</header>
<body background= "images/stucco.jpg">
	
	<div class="choix">
		<nav>
			<ul>
				<li><a href="#"><img src="images/auteur.jpg" alt ""/></a></li>
				<li><a href="#"><img src="images/journal.png" alt ""/></a></li>
				<li><a href="#"><img src="images/livre.png" alt ""/></a></li>
				<li><a href="#"><img src="images/autres.png" alt ""/></a></li>
			</ul>
		</nav>
	</div>
	<div class="image">
		<div class="description">
			<div class="barrederecherche">
				<form action="" class="formulaire">
					<input class="champ" type="text" placeholder="Entrez votre recherche ici...  "/>
					<input class="bouton" type="button" value="OK" />
				</form>
			</div>
		</div>
	</div>
	
	<h1>Rechercher & publier</h1>
	<p>Découverez des connaissances scientifiques <br> et rendez vos recherches visibles !</p>
	

</body>
<footer>
	<div class="bas_de_page">
		<div class="logo">
			
				<ul>
					<li><img src="images/bibliographie.jpg" alt "logo" /></li>
					<li><div class="trait"></div> </li>
					<li> <ul>
						<div class="thématique" > <h3>Thématique</h3>
							<li><a href="#">Culture & loisirs</a></li>
							<li><a href="#">Economie & commerce</a></li>
							<li><a href="#">Education</a></li>
							<li><a href="#">Informatique</a></li>
							<li><a href="#">Santé</a></li>
							<li><a href="#">Autres ...</a></li>
						</div>
					</ul> </li> 
					<li> <ul>
						<div class="contenus" > <h3>Contenus</h3>
							<li><a href="#">Articles</a></li>
							<li><a href="#">Dossiers</a></li>
							<li><a href="#">Proposer un sujet</a></li>
						</div>
					</ul> </li>
					
				</ul>
			
		</div>
	</div>
	 
</footer>

</html>
