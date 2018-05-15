<?php
	if (!isset($_POST)) {
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
	$d = null;
	try {
		$db = new PDO('mysql:host=localhost;dbname=dauphine_research_os;charset=utf8', 'root', '');
		post_article($db);
	} catch (Exception $e) {
		die('Erreur : ' . $e->getMessage());
	}

	function post_article($db) {

		$article_id = add_to_articles($db);
		add_to_mainarticle($db, $article_id);
		if ($_POST['hypothesis'] != "") add_to_hypothesis($db, $article_id);
		if ($_POST['experiences'] != "") add_to_workflow($db, $article_id);
		if ($_POST['conclusions'] != "") add_to_results($db, $article_id);
		/*if ($_POST['dataset'] != "") add_to_dataset($db, $article_id);*/
		header('Location: article.php?article_id='.$article_id);
		exit();
	}


	function add_to_hypothesis($db, $article_id) {

		global $d;

		try {
			$sql_query = "INSERT INTO hypothesis(article_id, content, dt_update, dt_create)
					      VALUES (?,?,?,?)";
			$content = $_POST['hypothesis'];
			$dt_update = $dt_creation = $d;
			$array = array($article_id, $content, $dt_update, $dt_creation);
			$query = $db->prepare($sql_query);
			$query->execute($array);
		}
		catch (Exception $e) {
			die('Erreur : ' . $e->getMessage());
		}
	}

	function add_to_workflow($db, $article_id) {

		global $d;

		try {
			$sql_query = "INSERT INTO workflow(article_id, content, dt_update, dt_create)
					      VALUES (?,?,?,?)";
			$content = $_POST['experiences'];
			$dt_update = $dt_creation = $d;
			$array = array($article_id, $content, $dt_update, $dt_creation);
			$query = $db->prepare($sql_query);
			$query->execute($array);
		}
		catch (Exception $e) {
			die('Erreur : ' . $e->getMessage());
		}
	}

	function add_to_results($db, $article_id) {

		global $d;

		try {
			$sql_query = "INSERT INTO results(article_id, content, dt_update, dt_create)
					      VALUES (?,?,?,?)";
			$content = $_POST['conclusions'];
			$dt_update = $dt_creation = $d;
			$array = array($article_id, $content, $dt_update, $dt_creation);
			$query = $db->prepare($sql_query);
			$query->execute($array);
		}
		catch (Exception $e) {
			die('Erreur : ' . $e->getMessage());
		}
	}



	function add_to_articles($db) {
		global $d;

		try
		{
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
			return $article_id;
		}
		catch (Exception $e) // Si erreur
		{
			die('Erreur : ' . $e->getMessage());
		}
	}

	function add_to_mainarticle($db, $article_id) {

		global $d;

		try {
			$sql_query = "INSERT INTO mainarticle(article_id, description, dt_update, dt_creation)
					      VALUES (?,?,?,?)";
			$description = $_POST['description'];
			$dt_update = $dt_creation = $d;
			$array = array($article_id, $description, $dt_update, $dt_creation);
			$query = $db->prepare($sql_query);
			$query->execute($array);
		}
		catch (Exception $e) {
			die('Erreur : ' . $e->getMessage());
		}
	}
?>