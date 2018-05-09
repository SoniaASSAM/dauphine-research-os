<?php

	session_start();
	add_user_to_db();

	function add_user_to_db(){

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
				header('Location: index.php');
				exit();
			} 
			else 
			{
				alert_js("Erreur, email existe deja");
				header('Location: signin.php');
				exit();
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
		$cpt = 0;

		if($query->rowCount() > 0)
			return false;
		return true;
	}

	function insert ($user_data, $db) {

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
			alert_js("Inscription OK");
			
	    }
		catch (Exception $e)
		{
		    die('Erreur : ' . $e->getMessage());
		}
	}

	function alert_js($text) {

		echo "<script language='javascript'>
					alert('".$text."');
			  </script>";
	}
?>