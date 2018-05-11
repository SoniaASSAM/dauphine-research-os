<html>
	<?php
		if (session_status() == PHP_SESSION_NONE)
    		session_start();
    	if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']) {
    		header('Location: index.php');
    		exit();
    	}
	?>
	<head>
		<title> Connexion  </title>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
		<link rel="stylesheet" type="text/css" href="projet.css">
		<script type="text/javascript">
			var validateForm = function(form) {
				var res;
				if (form.passwd.value === "")
					res = false;
				else if (form.email.value === '')
					res = false;
				else res = true;
				if (!res) alert('Erreur ! Formulaire incomplet');
				return res;
			} 
		</script>
	</head>


	<body>

		 <form  name="connexion" method="post" action="authentification.php" onsubmit="return validateForm(this)"/>	

			<label for="email"> Login :</label>
			<input type="email" name="email" class="text" id="email" method="post" placeholder="Email"/>
			
			<label for="passwd">Password:</label>
			<input type="password" name="passwd" class="text" id="passwd" method="post" placeholder="Password"/>
			
			<input type="submit" name="Submit" value="Se connecter" id="submit" method="post"/></br></br>				
		</form>
	</body>
</html>