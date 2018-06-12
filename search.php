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

		if ($result == null) {
			echo "<img src=\"https://image.flaticon.com/icons/svg/202/202381.svg\" alt=\"Nothing found\"  style=\"display: block;
					margin-left: auto;margin-right: auto;width: 20%;\">";
			echo "<h3>Oops, nous n'avons trouvé aucun résultat</h3>";
		}
		else {
			foreach ($result as $row) {
				print_element($row);
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
		echo '<div style="background:#f3f2f1;width: 100%;height: 50px;color:#afaead"><b>';
		echo "<p style=\"padding-left: 15px;\"><a href=article.php?article_id=".$article_id.">".$title."</a>";
		echo "</b></p><label style=\"font-family: Trebuchet MS, sans-serif;font-size: 13px;padding-left: 17px;\">".$last_name." ".$firstname." - ".$discipline." - ".$publicate_date." - 0 commentaires</label></div><br>";
	}
?>

<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="stylesheet" type="text/css" href="css/util.css">
		<title>Consultation Articles ¦ Dauphine Research Academy</title>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.css">
	</head>
	<body>
		<div>
			<ul>
				<li><a class="active" href="index.php">Home</a></li>
				<li><a class="active" href="load.php">Chargements d'artciles </a></li>
				<li><a class="active" href="index3.html">Consultation des articles</a></li>
				<li><a class="active" href="index2.html">Publication d'articles</a></li>
			</ul>
		</div>
		<div class="container-index100" style=" background-image: url('images/bg-01.jpg'); " >
			<img src="images/logo.png" class="logo">
			<h1> Dauphine Research Academy</h1>
			<a href="index.html"><button class="DeconnexionB"> Déconnexion </button></a>
		</div>
		<h2>Votre recherche concernant : <?php echo $_POST['element'];?> </h2>
		<div style="right:40px;position:absolute;">
				<form action="search.php" class="formulaire" method="post" onsubmit="return checkSearchForm()">
					<input name="element" id="element" class="champ" type="text" placeholder="Que voulez vous chercher ?"
						   style="border:1px solid black; border-radius: 30px; width:200px;height:30px"/>
					<input type="submit" 
				           style="position: absolute; left: -9999px; width: 1px; height: 1px;"
       			   		   tabindex="-1" />
				</form>
	</div>
		<br>
		<br>
		<br>
		<br>
		<div>
			<?php print_result(search_by_title($_POST['element'])); ?>
		</div>
	</body>
</html>

