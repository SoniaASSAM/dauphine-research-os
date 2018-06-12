<?php
	if (session_status() == PHP_SESSION_NONE)
    		session_start();
    if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']) {
    	header('Location: index.php');
    	exit();
    }
?>

<!DOCTYPE html>
	<header>
		<meta charset="utf-8" />
		<head>
			<meta name="viewport" content="width=device-width"/>
			<title>Connexion</title>

		    <link rel="stylesheet" type="text/css" href="style.css">
		    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.css">
		    <link rel="stylesheet" type="text/css" href="css/util.css">
		</head>
		<script type="text/javascript">
			var checkPassword = function() {
				if (document.getElementById('passwd').value ==
				document.getElementById('confirm_passwd').value)
					document.getElementById('confirm_passwd').style.borderColor = "green"
				else
					document.getElementById('confirm_passwd').style.borderColor = "red"
			}

			var validateSigninForm = function(form) {
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

			var validateLoginForm = function(form) {
				var res;
				if (form.passwd.value === "")
					res = false;
				else if (form.email.value === '')
					res = false;
				else res = true;
				if (!res) alert('Erreur ! Formulaire incomplet');
				return res;
			} 

			var validateLoginForm = function(form) {
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
	</header>
	<body>
		<div class="container-login100" style=" background-image: url('images/bg-01.jpg');">
    	<img src="images/logo.png" class="logo">

    <h1> Authentification | Dauphine Research Academy</h1>
    <div class="wrap-login100 p-l-55 p-r-55 p-t-80 p-b-30 ">

    	<section id="login_div">
            <form class="login100-form validate-form" method="post" action="authentification.php" onsubmit="return validateLoginForm(this)">
				<span class="login100-form-title p-b-37">
					Log in
				</span>

                <div class="wrap-input100 validate-input m-b-20" data-validate="Entrez votre email">
                    <input class="input100" type="text" name="email" placeholder="Email">
                    <span class="focus-input100"></span>
                </div>

                <div class="wrap-input100 validate-input m-b-25" data-validate="Entrez votre mot de passe">
                    <input class="input100" type="password" name="passwd" placeholder="Mot de passe">
                    <span class="focus-input100"></span>
                </div>

                <div class="container-login100-form-btn">
                    <button class="login100-form-btn" id="login">
                        Login
                    </button>
                </div>

                <br>

                <div class="text-center">
                    <p class="message">Pas encore enregistré ?
                        <button type="button" id="show-register" class="txt2 hov1">
                            S'enregistrer
                        </button>
                    </p>
                </div>
            </form>
        </section>

		 <section id="register_div">
            <form class="register100-form validate-form" method="POST" id="subscribtionForm" action="add_user_db.php" onsubmit="return validateSigninForm(this) ">
				<span class="login100-form-title p-b-37">
					Sign in
				</span>

                <div class="wrap-input100 validate-input m-b-20">
                    <input class="input100" type="email" name="email" placeholder="Email">
                    <span class="focus-input100"></span>
                </div>

                <div class="wrap-input100 validate-input m-b-20">
                    <input class="input100" type="text" id="firstname" name="firstname" placeholder="Prénom">
                    <span class="focus-input100"></span>
                </div>

                <div class="wrap-input100 validate-input m-b-20">
                    <input class="input100" type="text" name="familyname" id="familyname" placeholder="Nom">
                    <span class="focus-input100"></span>
                </div>

                <div class="wrap-input100 validate-input m-b-20">
                    <input class="input100" id="birth_date" type="date" name="birth_date">
                    <span class="focus-input100"></span>
                </div>

                <div class="wrap-input100 validate-input m-b-25">
                    <input class="input100" type="password" name="passwd" id="passwd" placeholder="Mot de passe" oninput="checkPassword()>
                    <span class="focus-input100"></span>
                </div>

                <div class="wrap-input100 validate-input m-b-25">
                    <input class="input100" type="password" name="confirm_passwd" id="confirm_passwd" placeholder="Confirmation de mot de passe" oninput="checkPassword()>
                    <span class="focus-input100"></span>
                </div>

                <div class="container-login100-form-btn">
                    <button class="login100-form-btn" id="login">
                        Login
                    </button>
                </div>

                <br>

                <div class="text-center">
                    <p class="message">Déjà enregistré ?
                        <button type="button" id="show-login" class="txt2 hov1">
                            Se connecter
                        </button>
                    </p>

                </div>
            </form>

        </section>
</div>
	<script
        src="https://code.jquery.com/jquery-1.12.4.js"
        integrity="sha256-Qw82+bXyGq6MydymqBxNPYTaUXXq7c8v3CwiYwLLNXU="
        crossorigin="anonymous"></script>
<style>
    div.expanded {
        border-radius: 6px;
        transition: all 1s ease;
    }
    div.wrap-login100{
        transition: all 1s ease;
    }
</style>
<script type="text/javascript">
    $(document).ready(function () {
        $("#show-register").on("click", function () {

            $("#login_div").attr("class", "animated rotateOut").fadeOut("slow", function () {
                $("#login_div").parent().addClass("expanded");
                $("#register_div").attr("class", "animated flipInY").fadeIn('fast');
                $(this).removeClass("animated rotateOut");
            })
        });

        $("#show-login").on("click", function () {

            $("#register_div").attr("class", "animated flipOutY").fadeOut("slow", function () {
                $("#register_div").parent().removeClass("expanded");
                $("#login_div").attr("class", "animated rotateIn").fadeIn('fast');
                $(this).removeClass("animated flipOutY");
            })
        });
    });

</script>
	</body>
	<footer>
	</footer>
</html>