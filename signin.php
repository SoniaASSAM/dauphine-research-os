<?php
	if (isset($_SESSION['loggedIn']) && $_SESSION["loggedIn"]) {
		header('Location: index.php');
  		exit();
	}
?>

<!DOCTYPE html>
	<header>
		<meta charset="utf-8" />
		<head>
			<title>Dauphine Research Object System</title>
			<meta name="viewport" content="width=device-width"/>
			<link rel="stylesheet" href="projet.css" />
		</head>
		<script type="text/javascript">
			var checkPassword = function() {
				if (document.getElementById('passwd').value ==
				document.getElementById('confirm_passwd').value)
					document.getElementById('confirm_passwd').style.borderColor = "green"
				else
					document.getElementById('confirm_passwd').style.borderColor = "red"
			}

			var validateForm = function(form) {
				var res;
				if (form.confirm_passwd.style.borderColor == 'red')
					res = false;
				else if (form.passwd.value === "")
					res = false;
				else if (form.familyname.value === '')
					res = false;
				else if (form.firstname.value === '')
					res = false;
				else res = true;
				if (!res) alert('Erreur ! Verifiez vos informations');
				return res;
			} 
		</script>
	</header>
	<body>
		<br>
		<section id="subscribingDiv">
			<h3>Inscrivez vous</h3>
			<form  action="add_user_db.php" method="POST" id="subscribtionForm" onsubmit="return validateForm(this)">
				<input type="email" id="email" name="email" placeholder="E-mail"><br>
				<input type="password" id="passwd" name="passwd" placeholder="Mot de passe" oninput="checkPassword()"><br>
				<input type="password" id="confirm_passwd" name="confirm_passwd" placeholder="Confirmation" oninput="checkPassword()"><br>
				<input type="text" id="familyname" name="familyname" placeholder="Nom"><br>
				<input type="text" id="firstname" name="firstname" placeholder="Prenom"><br>
				<input type="date" id="birth_date" name="birth_date" required pattern="(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])/(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])/(?:30))|(?:(?:0[13578]|1[02])-31))" placeholder="AAAA-MM-JJ"><br>
				<button type="submit">Inscription</button>
			</form>
		</section>
	</body>
	<footer>
	</footer>
</html>