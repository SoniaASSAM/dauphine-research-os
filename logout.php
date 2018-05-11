<?php
	if (session_status() == PHP_SESSION_NONE)
    	session_start();
    try
	{
		$db = new PDO('mysql:host=localhost;dbname=dauphine_research_os;charset=utf8', 'root', '');
		$update_connection_status = "UPDATE users 
			 						 set connected = ?
			 						 WHERE email = ?";
		$array = array(false, $email);
		$query = $db-> prepare($update_connection_status);
		$query->execute($array);
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