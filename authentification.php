<?php

	if (session_status() == PHP_SESSION_NONE)
    	session_start();
   	$familyname = null;
   	$firstname = null;
   	$uid = null;
    connect_user($_POST);



	function check_user($email, $passwd) {

		global $familyname, $firstname, $uid;
		try
		{
			$db = new PDO('mysql:host=localhost;dbname=dauphine_research_os;charset=utf8', 'root', '');
		}
		catch (Exception $e) // Si erreur
		{
			die('Erreur : ' . $e->getMessage());
		}
		$hash_passwd = md5($passwd);
		$query = $db->prepare('select * from users where email=?');
		$query->bindValue(1,$email);
		$query->execute();
		$test = false;
		foreach ($query->fetchAll(PDO::FETCH_ASSOC) as $row) {
			if ($row['passwd'] == $hash_passwd) 
			{
				$test = true;
				$familyname = $row['last_name'];
				$firstname = $row['first_name'];
				$uid = $row['user_id'];
			}
		};

		if (!$test) 
			echo '<script type="text/javascript">
					alert("Erreur authentification! Adresse email ou mot de passe invalide");
					window.location.href = "login.php";
				  </script>';
		else 
		{
			date_default_timezone_set('UTC');
			$d = date("Y-m-d H:i:s");
			$update_connection_status = "UPDATE users 
			 						     set connected = ?  last_connection = ?
			 							 WHERE email = ?";
			$array = array(1, $d, $email);
			$query = $db-> prepare($update_connection_status);
			$query->execute($array);
		}
		$query->closeCursor();
		return $test;
	}

	function connect_user($user_data) {

		global $familyname, $firstname, $uid;

		if (check_user($user_data['email'], $user_data['passwd'])) {
			$_SESSION['familyname'] = $familyname;
			$_SESSION['firstname'] = $firstname;
			$_SESSION['email'] = $user_data['email'];
			$_SESSION['loggedIn'] = true;
			$_SESSION['user_id'] = $uid;
			echo '<script type="text/javascript">
					alert("Connexion réussie");
					window.location.href = "index.php";
				  </script>';
		}
	} 
?>