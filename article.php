<?php
	if (session_status() == PHP_SESSION_NONE)
    	session_start();
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
		  
		  <div class="tab-panels">
		    <section id="Article" class="tab-panel">
		      <h2>Article principal</h2>
		   	</section>
		  	<section id="hypotheses" class="tab-panel">
		  		<h2>Hypothèses</h2>
		  	</section>
			<section id="experiences" class="tab-panel">
				<h2>Expériences</h2>
			</section>
			<section id="donnes" class="tab-panel">
				<h2>Jeux de données</h2>
			</section>
			<section id="conclusions" class="tab-panel">
				<h2>Résultats et conclusions</h2>
			</section>
		</div>
	</body>
</html>