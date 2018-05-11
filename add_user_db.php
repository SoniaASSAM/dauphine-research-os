<?php

	if (session_status() == PHP_SESSION_NONE)
    	session_start();
    $uid = null;
	add_user_to_db();

	function add_user_to_db(){
		global $uid;
		if (!isset($_POST) || empty($_POST['email'])) {
			header('Location: index.php');
			exit();
		}
		if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']) {
			header('Location: index.php');
			exit();
		}
		try
		{
	    	$db = new PDO('mysql:host=localhost;dbname=dauphine_research_os;charset=utf8', 'root', '');
	    	if (check_in_db($_POST['email'], $db)) {
				insert($_POST, $db);
				$_SESSION['familyname'] = $_POST['familyname'];
				$_SESSION['firstname'] = $_POST['firstname'];
				$_SESSION['email'] = $_POST['email'];
				$_SESSION['loggedIn'] = true;
				$_SESSION['user_id'] = $uid;
				alert_js("Inscription réussie", "index.php");
			} 
			else 
			{
				alert_js("Erreur, email existe deja","");
				$db = null;
			}
	    }
		catch (Exception $e)
		{
		    die('Erreur : ' . $e->getMessage());
		}
	}

	function check_in_db($email, $db) {
		$query = $db->prepare('select * from users where email= ?');
		$query->bindValue( 1, $email );
		$query->execute();

		if($query->rowCount() > 0)
			return false;
		return true;
	}

	function insert ($user_data, $db) {

		global $uid;
		try
		{
	    	date_default_timezone_set('UTC');
			$d = date("Y-m-d H:i:s");
			$lastname = $user_data['familyname'];
			$firstname = $user_data['firstname'];
			$email = $user_data['email'];
			$connected = true;
			$passwd = md5($user_data['passwd']);
			$last_connection = $d;
			$subscription_date = $d;
			$birth_date = $user_data['birth_date'];
			$req = $db->prepare('INSERT INTO users(last_name, first_name, email, connected, passwd, last_connection, subscription_date, birth_date) 
								 VALUES(?, ?, ?, ?, ?, ?, ?, ?)');
			$array = array($lastname, $firstname, $email, $connected, $passwd, $last_connection, $subscription_date, $birth_date);
			$req->execute($array);
			$req = $db->prepare('SELECT user_id from users WHERE email=?');
			$req->bindValue(1,$email);
			$req->execute();
			foreach ($req->fetchAll(PDO::FETCH_ASSOC) as $row) {
				$uid = $row['user_id'];
			};
			$req->closeCursor();
	    }
		catch (Exception $e)
		{
		    die('Erreur : ' . $e->getMessage());
		}
	}

	function alert_js($text, $link) {
		echo "<script language='javascript'>
					alert('".$text."');
					window.location.href='".$link."';
			  </script>";
	}
?>