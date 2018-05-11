<?php
	if (!isset($_POST) || empty($_POST['title'])) {
			header('Location: index.php');
			exit();
	}
	session_start(); // On démarre la session AVANT toute chose
	if (!isset($_SESSION['loggedIn']) || !$_SESSION["loggedIn"]) {
		header('Location: index.php');
  		exit();
	}	

	$article_id = null;
	$db = null;
	$d;
	post_article();

	function post_article() {
		
		global $article_id;
		add_to_articles();
		add_to_mainarticle();
		header('Location: article.php?article_id='.$article_id);
		exit();
	}

	function add_to_articles() {

		global $article_id;
		global $db;
		global $d;

		try
		{
			$db = new PDO('mysql:host=localhost;dbname=dauphine_research_os;charset=utf8', 'root', '');
			date_default_timezone_set('UTC');
			$d = date("Y-m-d H:i:s");
			$title = $_POST['title'];
			$publicate_date = $update_date = $d;
			$nb_views = 0;
			$discipline = $_POST['discipline'];
			$article_owner = $_SESSION['user_id'];
			$sql_query = "INSERT INTO articles(title,publicate_date,update_date,nb_views, discipline, article_owner)
						  VALUES (?,?,?,?,?,?)";
			$array = array($title,$publicate_date,$update_date,$nb_views,$discipline,$article_owner);
			$query = $db->prepare($sql_query);
			$query->execute($array);
			$article_id = $db->lastInsertId();
			$query->closeCursor();
		}
		catch (Exception $e) // Si erreur
		{
			die('Erreur : ' . $e->getMessage());
		}
	}

	function add_to_mainarticle() {

		global $db, $article_id;

		try {
			$sql_query = "INSERT INTO mainarticle(article_id, description, dt_update, dt_creation)
					      VALUES (?,?,?,?)";
			$description = $_POST['description'];
			$dt_update = $dt_creation = $d;
			$array = array($article_id, $description, $dt_update, $dt_creation);
			$query = $db->prepare($sql_query);
			$query->execute($array);
			$query->closeCursor();
		}
		catch (Exception $e) {
			die('Erreur : ' . $e->getMessage());
		}
		
	}
?>