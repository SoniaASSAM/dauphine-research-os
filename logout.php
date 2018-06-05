<?php
	if (session_status() == PHP_SESSION_NONE)
    	session_start();

    if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] == false) {
    	header('Location: index.php');
		exit();
    }
    
    try
	{
		$db = new PDO('mysql:host=localhost;dbname=dauphine_research_os;charset=utf8', 'root', '');
		$update_connection_status = "UPDATE users 
			 						 set connected = ?
			 						 WHERE user_id = ?";
		$array = array(0, $_SESSION['user_id']);
		$query = $db-> prepare($update_connection_status);
		$query->execute($array);
		echo $db->lastInsertId();
		$query->closeCursor();
	}
	catch (Exception $e) // Si erreur
	{
		die('Erreur : ' . $e->getMessage());
	}
    $_SESSION=array();
	session_destroy();
	header('Location: index.php');
	exit();
?>