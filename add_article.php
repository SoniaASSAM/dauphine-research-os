<?php
	if (session_status() == PHP_SESSION_NONE)
    	session_start();
	if (!isset($_SESSION['loggedIn']) || !$_SESSION["loggedIn"]) {
		header('Location: index.php');
		exit();
	}
?>

<!DOCTYPE html>
<html>
	<header>
		<head>
		  <script>
			function submitArticle() {
				document.getElementById("articleForm").submit();
			}
		  </script>
		  <meta charset="UTF-8">
		  <title>Article</title>
		  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
		  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Overpass:300,400,600,800'>
		  <link rel="stylesheet" href="style.css">
		  <link rel="stylesheet" href="projet.css" />
		  <div class="boutons">
				<?php echo 
					"<ul>
						<li>Hello ".$_SESSION["firstname"]." ".$_SESSION['familyname']."</li>
						<li><a href='add_article.php'>Nouvel article</a></li>
						<li><a href='logout.php'>Déconnexion</a></li>
					</ul>"
				?>
		</head>

		
	</header>

	<body>
		<div class="tabset" name="tabsetDiv">
			  <!-- Tab 1 -->
			  <input type="radio" name="tabset" id="article" aria-controls="Article" checked>
			  <label for="article">Article</label>
			  <!-- Tab 2 -->
			  <input type="radio" name="tabset" id="hypotheses" aria-controls="Hypothèses">
			  <label for="hypotheses">Hypothèses</label>
			  <!-- Tab 3 -->
			  <input type="radio" name="tabset" id="experiences" aria-controls="Expérience">
			  <label for="experiences">Expériences</label>
			  <!-- Tab 4 -->
			  <input type="radio" name="tabset" id="donnees" aria-controls="Données">
			  <label for="donnees">Données</label>
			  <!-- Tab 5 -->
			  <input type="radio" name="tabset" id="conclusions" aria-controls="Conclusions">
			  <label for="conclusions">Conclusions</label>
			  <!-- Enregistrer l'article dans la base-->
			  <input type="radio" name="tabset" id="publish" aria-controls="publish" onchange="submitArticle()">
			  <label for="publish">Enregistrer et publier</label>
		  
		  <div class="tab-panels">
		    <section id="Article" class="tab-panel">
		      <h2>Article principal</h2>
		      <div id="createArticle" class="divForm">
				<form id="articleForm" action="add_article_db.php" method="POST">
					<input type="text" id="title" name="title" placeholder="Titre de l'article"/><br>
					<select name="discipline" size="1" id="disciplineChoices" placeholder="Choisir la discipline">
						<option>Informatique
						<option>Mathématiques
						<option>Langues
						<option>Médecine
						<option>Economie/Finances
						<option>Marketing
						<option>Supply Chain
						<option>Biologie
					</select><br>
					<textarea placeholder="Exprimez vous" name="description"></textarea>
				</div>
		   	</section>
		  	<section id="hypotheses" class="tab-panel">
		      	<input type="text" name="hyp1">
		  	</section>
			<section id="experiences" class="tab-panel">
				<input type="text" name="exp1">
			</section>
			<section id="donnes" class="tab-panel">
				<input type="file" name="dataset1">
			</section>
			<section id="conclusions" class="tab-panel">
				<input type="text" name="conclusion1">
			</section>
			<section id="publish" class="tab-panel">
			</section>
		</form>
		  </div>
		</body>
</html>