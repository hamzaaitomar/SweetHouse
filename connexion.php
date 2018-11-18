<?php
include 'config.php';
if(isset($_POST['submit']))
{
	$request = $pdo->prepare('SELECT * FROM user WHERE email = ?');
	$request->execute(array($_POST['email']));
	$result = $request->fetch();
	if($result['lastName'] != null)
	{
		if(password_verify($_POST['password'], $result['password']))
		{
			$_SESSION["email"] = $result['email'];
			if(isset($_POST['remember']))
			{	
				$_SESSION = array();
				session_destroy();
			}
		}
		else
		{
			$notification = array("type" => "error","message" => "Mot de passe incorrect !");
		}
	}
	else
	{
		$notification = array("type" => "error","message" => "Aucun compte lié à cet email trouvé !");
	}
}
?>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="style.css" /> 
	<title>SweetHouse | Connexion</title>
</head>
<body>
	<?php include 'header.php' ?>
	<?PHP include 'notification.php' ?>
	<div id="form-container">
		<form method="POST">
			<h2 id="title">Connexion</h2>
			<hr>
			<div class="input-group">
				<label for="email">Adresse email :</label>
				<input type="email" name="email" value="test@test.fr">
			</div>

			<div class="input-group">
				<label for="password">Mot de passe :</label>
				<input type="password" name="password" value="test">
			</div>
			<div class="input-group">
				<label for="remember">Se souvenir de moi :</label>
				<input type="checkbox" name="remember">
			</div>
			<div class="input-group">
				<input type="submit" name="submit" value="Valider" id="validate-button">
			</div>
		</form>
	</div>
</body>
</html>
<style>
body{
	text-align: center; 
}
#form-container{
	display: inline-block;
	text-align: left;
	margin-top: 25px;
	background-color: #65c0ba;
	padding: 15px;
	border: 2px solid black;
}
#title{
	text-align: center;
}
.input-group{
	margin-top: 15px;
}
label{
	display: inline-block;
}
hr{
	margin-bottom: 20px;
}
</style>