<?php
	if (session_status() == PHP_SESSION_NONE)
    	session_start();
	if (!isset($_SESSION['loggedIn']) || !$_SESSION["loggedIn"]) {
		header('Location: index.php');
		exit();
	}
?>
	
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Publication Articles  ¦ Dauphine Research Academy</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.css">
    <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Overpass:300,400,600,800'>
    <script type="text/javascript">
    	function submitArticle() {
				if (validateForm()) 
					document.getElementById("articleForm").submit();
				else {
					alert("Formulaire incomplet!");
					document.getElementById("article").checked = true;
				}
			}

			function validateForm() {
				form = document.getElementById('articleForm');
				if (form.description.value === "") return false;
				else if (form.title.value === "") return false;
				else return true;
			}
    </script>

</head>
<body>

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
                    <table>
                   <tr>
                       <th><label> Titre : </label></th>
                    <th><input type="text" class="input100" id="title" name="title" placeholder="Titre de l'article" style="border:1px solid black; border-radius: 30px; width:200px;height:30px"/></th>
                   </tr>
                   <tr>
                       <th> <label>Theme :</label> </th>
                   <th><select name="discipline" size="1" id="disciplineChoices" placeholder="Choisir la discipline" style="width: 200px;">

                        <option>Informatique
                        <option>Mathématiques
                        <option>Langues
                        <option>Médecine
                        <option>Economie/Finances
                        <option>Marketing
                        <option>Supply Chain
                        <option>Biologie
                    </select>
                   </th>
                   </tr>
                    <tr>
                        <th> <label>Texte : </label></th>
                        <th><textarea placeholder="Exprimez-vous" name="description" ng-model="loremIpsum" ng-keyup="autoExpand($event)"></textarea> </th> </tr>
                    </table>
            </div>
        </section>
        <section id="hypotheses" class="tab-panel">
            <textarea name="hypothesis" placeholder="Vos hypothèses de départ"></textarea>
        </section>
        <section id="experiences" class="tab-panel">
            <textarea name="experiences" placeholder="Les expériences que vous avez effectué"></textarea>
        </section>
        <section id="donnes" class="tab-panel">
            <label for="dataset">Votre jeu de données : </label>
            <input type="file" name="dataset" id="dataset">
        </section>
        <section id="conclusions" class="tab-panel">
            <textarea name="conclusions" placeholder="Conclusions ?"></textarea>
        </section>
        <section id="publish" class="tab-panel">
            <label> Merci de cliquer sur le bouton "Enregistrer et publier" pour que votre article soit sauvegardé .</label>
        </section>
        </form>
    </div>
</div>



<div>

</div>


<script>



    var app = angular.module('myApp', []);

    app.controller('AppCtrl', ['$scope', '$http', '$timeout', function($scope, $http, $timeout) {

        // Load the data
        $http.get('http://www.corsproxy.com/loripsum.net/api/plaintext').then(function (res) {
            $scope.loremIpsum = res.data;
            $timeout(expand, 0);
        });

        $scope.autoExpand = function(e) {
            var element = typeof e === 'object' ? e.target : document.getElementById(e);
            var scrollHeight = element.scrollHeight -60; // replace 60 by the sum of padding-top and padding-bottom
            element.style.height =  scrollHeight + "px";
        };

        function expand() {
            $scope.autoExpand('TextArea');
        }
    }]);




</script>

</body>
</html>
