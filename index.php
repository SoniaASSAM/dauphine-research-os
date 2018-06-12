<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./style.css">
    <title>Acceuil ¦ Dauphine Research Academy</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.css">

</head>
<body>

<div class="container-index100" style=" background-image: url('images/bg-01.jpg'); " >
    <img src="images/logo.png" class="logo">

    <h1> Dauphine Research Academy</h1>
    <h3> The first website for researches </h3>
			<div style="right:40px;position:absolute;">
				<form action="search.php" class="formulaire" method="post" onsubmit="return checkSearchForm()">
					<input name="element" id="element" class="champ" type="text" placeholder="Que voulez vous chercher ?"
						   style="border:1px solid black; border-radius: 30px; width:200px;height:30px"/>
					<input type="submit" 
				           style="position: absolute; left: -9999px; width: 1px; height: 1px;"
       			   		   tabindex="-1" />
				</form>
			</div>

	<?php
		session_start();
		if (isset($_SESSION['loggedIn']) && $_SESSION["loggedIn"]) {
			echo '<a href="add_article.php"><button class="NouvelArticleB"> Nouvel article </button></a>';
   			echo '<a href="import.php"><button class="inscriptionB"> Importer un article</button></a>';
   			echo '<a href="logout.php"><button class="DeconnexionB"> Déconnexion </button></a>';
		}
		else {
			echo '<a href="connection.php"><button class="connexionB"> Connexion </button></a>';
   			echo '<a href="connection.php"><button class="inscriptionB"> Inscription </button></a>';
   		}
	?>
</div>

<br><br>

<div>
    <p style="float: left;"> <img src="images/graduates.png" style="position:relative;left:40%;"> </p>
    <p style="position:relative;left:20%;font-style: bold;line-height:30px;font-size: 30px;font-family: Impact, fantasy;">
        Une communauté de chercheurs
    </p> <br>
    <p style="position:relative;left:10%;font-style: italic;line-height:30px;font-size: 20px;width:1200px;">
        Ceci est un site de partage entre chercheurs et public commun. L'idée est que chacun puisse partager ses recherches,
        découvertes ou réflexions de manières organisées et intuitives. Avec un système révolutionnaire de présentation des aricles, les recherches scientifiques deviennent accessibles à tous !
    </p>

</div>


<div id="conteneur" class="container-index100" style="background-image:url('images/blue.jpg');">
    <div id="un"> <img src="images/atomic.png" style="width:70px;"> <h4> Espace de partage </h4> </div>
    <div class="ligne_verticale" ></div>

    <div id="deux"> <img src="images/verified-text-paper.png" style="width:70px;"> <br> <h4> Espace de publication</h4> </div>
    <div class="ligne_verticale" ></div>

    <div id="trois"> <img src="images/computer.png" style="width:70px;"> <br> <h4> Espace de consultation</h4> </div>
</div>


  <div id="conteneur"> 
    <br><br>
      <p class="about" > A propos du Dauphine Research Academy </p>
        <p style="float: left;"> <img src="images/dauphine.jpg" style="width:400px;position:relative;left:10%;" > </p>
      <p style="position:relative;left:1%;font-style: italic;line-height:30px;font-size: 20px;left:7%;width:1200px;">
          L'Université Paris-Dauphine occupe un positionnement unique dans le secteur de l’enseignement supérieur
          français. Son offre de formation toujours plus attractive, la renommée internationale croissante de ses
          équipes scientifiques, et la reconnaissance de son modèle de développement obtenue avec l’accréditation
          Equis font de Paris-Dauphine l’établissement français de référence en sciences des organisations et de
          la décision.
      </p>
  </div>

 <!-- Slideshow container -->
<div class="slideshow-container">

    <!-- Full-width images with number and caption text -->
    <div class="mySlides fade">
        <img src="images/dauphin.jpg" style="width:40%;height: 40%;">
                <div class="text">
            Un auteur publie en moyenne
            <?php
  $db = new PDO('mysql:host=localhost;dbname=dauphine_research_os;charset=utf8', 'root', '');
  $reponse = $db->query('select AVG (nb) as moy from (select article_owner, count(article_owner) as nb from articles group by article_owner) as compteur;');


            while ($donnees = $reponse->fetch()){
            echo round($donnees['moy'],2);
            }
            ?>

            Par année
        </div>
    </div>

    <div class="mySlides fade">
        <img src="images/dauphin.jpg" style="width:40%;height: 40%;">
                <div class="text">En moyenne,
            <?php
  $db = new PDO('mysql:host=localhost;dbname=dauphine_research_os;charset=utf8', 'root', '');
  $reponse = $db->query('select AVG (nb) as moy from (select year(publicate_date) as annee, count(*) as nb from articles group by annee) as compteur;');


            while ($donnees = $reponse->fetch()){
            echo round($donnees['moy'],2);
            }
            ?>
            sont publiés chaque année.
        </div>
    </div>

    <div class="mySlides fade">
        <img src="images/dauphin.jpg" style="width:40%;height: 40%;">
                <div class="text2">
            Le nombre moyen de publications par auteur par année:
            </br>
            <?php
                $db = new PDO('mysql:host=localhost;dbname=dauphine_research_os;charset=utf8', 'root', '');
                $reponse = $db->query('select annee, avg(nb) as moy from (select year(publicate_date) as annee, article_owner as auteur, count(*) as nb from articles group by annee, article_owner) aa group by annee');


            while ($donnees = $reponse->fetch()){
            $moy = round($donnees['moy'],2);
            $annee = $donnees['annee'];
            echo "En $annee : <span style='color:blue;'> $moy </span> articles/auteur. </br>";
            }
            ?>
            </p>
        </div>
    </div>

<div class="mySlides fade">
        <img src="images/dauphin.jpg" style="width:40%;height: 40%;">
        <div class="text">
                En moyenne, il y a
                <?php
                  $db = new PDO('mysql:host=localhost;dbname=dauphine_research_os;charset=utf8', 'root', '');
                  $reponse = $db->query('Select avg(nb2)as moy from (select annee, count(nb) as nb2 from (select year(publicate_date) as annee, article_owner as auteur, count(*) as nb from articles group by annee, article_owner ) aa group by annee)bb');


                while ($donnees = $reponse->fetch()){
                    echo round($donnees['moy'],2);
                }



                ?>
                auteurs par années.
        </div>
    </div>
    <!-- Next and previous buttons -->
    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next" onclick="plusSlides(1)">&#10095;</a>
</div>
<br>

<!-- The dots/circles -->
<div style="text-align:center">
    <span class="dot" onclick="currentSlide(1)"></span>
    <span class="dot" onclick="currentSlide(2)"></span>
    <span class="dot" onclick="currentSlide(3)"></span>
    <span class="dot" onclick="currentSlide(4)"></span>

</div>

</body>


<script>

    var slideIndex = 1;
    // showSlides(slideIndex);

    // Next/previous controls
    function plusSlides(n) {
        showSlides(slideIndex += n);
    }

    // Thumbnail image controls
    function currentSlide(n) {
        showSlides(slideIndex = n);
    }

    function showSlides(n) {
        var i;
        var slides = document.getElementsByClassName("mySlides");
        var dots = document.getElementsByClassName("dot");
        if (n > slides.length) {slideIndex = 1}
        if (n < 1) {slideIndex = slides.length}
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex-1].style.display = "block";
        dots[slideIndex-1].className += " active";
    }

    var slideIndex = 0;
showSlides();

function showSlides() {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none"; 
    }
    slideIndex++;
    if (slideIndex > slides.length) {slideIndex = 1} 
    slides[slideIndex-1].style.display = "block"; 
    setTimeout(showSlides, 4000); // Change image every 2 seconds
}


</script>


</body>
</html>
