<?php
	
	if ($_POST['element'] == null || $_POST['element'] == "") {
		header("Location: index.php");
		exit();
	}
	ini_set('session.cache_limiter','public');
	session_cache_limiter(false);

	$db = new PDO('mysql:host=localhost;dbname=dauphine_research_os;charset=utf8', 'root', '');


	function search_by_title($element) {
		
		global $db;
		// $db = new PDO('mysql:host=localhost;dbname=dauphine_research_os;charset=utf8', 'root', '');
		$sql_query = 'SELECT article_id, title, discipline, publicate_date, article_owner FROM articles WHERE title LIKE ?';
		$query = $db->prepare($sql_query);
		$t = '%'.$element.'%';
		$query->bindParam(1, $t);
		$query->execute();
		if ($query->rowCount() == 0)
  			$result = null;
  		else $result = $query->fetchAll();
  		return $result;
	}

	function get_user_info($user_id) {
		global $db;
		$sql_query = "SELECT last_name, first_name FROM users WHERE user_id=?";
		$query = $db->prepare($sql_query);
		$query->bindParam(1,$user_id);
		$query->execute();
		$result = $query->fetch();
		return array($result['last_name'],$result["first_name"]);
	}

	function print_result($result) {
		global $db;

		if ($result == null) 
			echo "Aucun résultat trouvé";
		else {
			foreach ($result as $row) {
				echo "<ul>";
				print_element($row);
				echo "</ul>";

			}
		}
	}


	function print_element($row) {
		$article_id = $row['article_id'];
		$article_owner = $row['article_owner'];
		$owner_info = get_user_info($article_owner);
		$last_name = $owner_info[0];
		$firstname = $owner_info[1];
		$publicate_date = $row["publicate_date"];
		$title = $row['title'];
		$discipline = $row['discipline'];
		echo '<li>';
		echo "<h3><a href=article.php?article_id=".$article_id.">".$title."</a></h3>";
		echo "<p>".$last_name." ".$firstname." - ".$discipline." - ".$publicate_date." - 0 commentaires</p>";
		echo '</li>';
	}
?>

<!DOCTYPE html>
<html>
	<header>
		<head>
			<meta charset="utf-8" />
			<title>Recherche</title>
			<meta name="viewport" content="width=device-width"/>
			<!--<link rel="stylesheet" href="projet.css" />-->
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
	<body>
		<h2>Votre recherche concernant : <?php echo $_POST['element'];?> </h2>

		<div id="result" class="article_result">
			<?php print_result(search_by_title($_POST['element'])); ?>
		</div>
	</body>
</html>