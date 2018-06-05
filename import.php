<?php

session_start();
if (!isset($_SESSION['loggedIn']) || !$_SESSION["loggedIn"]) {
	header("Location : index.php");
	exit();
}

else if ($_POST["xmlFile"] == null || $_POST['xmlFile'] == "") {
	header("Location : index.php");
	exit();
}

else load($_POST['xmlFile']);

function load($file_path) {
	$db = new PDO('mysql:host=localhost;dbname=dauphine_research_os;charset=utf8', 'root', '');
	$articles_xml = simplexml_load_file($file_path);
	foreach ($articles_xml->book as $article){
		add_book($db, $article);
	}
	foreach ($articles_xml->incollection as $article){
		add_book($db, $article);
	}
	echo "<script>alert('Articles chargés'); window.location.href='index.php'</script>";
}

function add_book($db, $article) {

	$author = $article->author[0];
	echo($author);
	$title = $article->title;
	$dt = $article->year;
	$sql = 'SELECT * FROM users WHERE last_name = ? AND first_name = ?';
	$first_name = explode(" ", $author)[0];
	$last_name = explode(" ", $author)[1];
	$req = $db->prepare($sql);
	$req->execute(array($last_name, $first_name));
	if ($req->rowCount()>0) {
		$row = $req->fetch();
		$article_owner=$row['user_id'];
	}
	else
		$article_owner = create_user($db, $last_name, $first_name);
	add_article($db, $article_owner, $article);
}

function create_user($db, $last_name, $first_name) {
	date_default_timezone_set('UTC');
	$d = date("Y-m-d H:i:s");
	$req = $db->prepare('INSERT INTO users(last_name , first_name, email, connected, passwd,last_connection, subscription_date, birth_date)
						 VALUES(?, ?, ?, ?, ?, ?, ?, ?)');
	$array = array($last_name,$first_name,$last_name.".".$first_name."@mail.com", 0, "importpswd", $d, $d, $d);
	$req->execute($array);
	$article_owner = $db->lastInsertId();
	return $article_owner;
}

function add_article($db, $article_owner, $article) {
	$title = $article->title;
	$dt = $article["mdate"];
	$req = $db->prepare('INSERT INTO articles(title, publicate_date , update_date, nb_views, discipline, article_owner, content)VALUES(?, ?, ?, ?, ?, ?, ?)');
	$array = array($title, $dt, $dt, 0, "Informatique", $article_owner, "article importé");
	$req->execute($array);
}

?>