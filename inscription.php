<?php
include 'config.php';

require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';

if(isset($_POST['submit']))
{
	if(isset($_POST['cgu']))
	{
		if(isset($_POST['lastName']) && isset($_POST['firstName']) && isset($_POST['password']) && isset($_POST['password2']) && isset($_POST['gender']) && isset($_POST['type']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['adress']) && isset($_POST['zipCode']) && isset($_POST['city']) && isset($_POST['country']))
		{
			if($_POST['password'] == $_POST['password2'])
			{
				$role = 0;
				$hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
				$sql = "INSERT INTO users (name, surname, sex) VALUES (:name, :surname, :sex)";
				$request = $pdo->prepare("INSERT INTO user (role,lastName, firstName, password,gender,type,email,phone,adress,zipCode,city,country) VALUES (:role, :lastName, :firstName,:password,:gender,:type,:email,:phone,:adress,:zipCode,:city,:country)");
				$request->execute(array("role" => $role,"lastName" => $_POST['lastName'], "firstName" => $_POST['firstName'],"password" => $hash,"gender" => $_POST['gender'],"type" => $_POST['type'], "email" => $_POST['email'],"phone" => $_POST['phone'],"adress" => $_POST['adress'],"zipCode" => $_POST['zipCode'],"city" => $_POST['city'],"country" => $_POST['country']));	
				if($request->errorInfo()[2] != ""){
					$error_parameters = array();
					preg_match("/for key '(\w+)'$/", $request->errorInfo()[2], $error_parameters);
					if(sizeof($error_parameters) == 2 && $error_parameters[1] == "email")
					{
						$notification = array("type" => "error","message" => "Email déja pris !");
					}
					elseif(sizeof($error_parameters) == 2 && $error_parameters[1] == "phone")
					{
						$notification = array("type" => "error","message" => "Numéro de télephone déja pris !");
					}
					else
					{
						$notification = array("type" => "error","message" => "Une erreur est survenue !");
					}
				}
				else
				{
					$notification = array("type" => "success","message" => "Utilisateur enregistré !");	
					$mail = new PHPMailer;
					$mail->isSMTP(); 
					$mail->SMTPDebug = 0; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
					$mail->Host = "smtp.easyname.com"; // use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
					$mail->Port = 587; // TLS only
					$mail->SMTPSecure = 'tls'; // ssl is depracated
					$mail->SMTPAuth = true;
					$mail->Username = "160227mail1";
					$mail->Password = "sweethouse";
					$mail->setFrom("contact@sweethouse.co.at", "SweetHouse");
					$mail->addAddress($_POST['email'], $_POST['lastName']);
					$mail->Subject = 'SweetHouse';
					$mail->msgHTML("Parce que c'est notre projet"); //$mail->msgHTML(file_get_contents('contents.html'), __DIR__); //Read an HTML message body from an external file, convert referenced images to embedded,
					$mail->AltBody = 'HTML messaging not supported';

					if(!$mail->send()){
					}else{
					}
				}
			}
			else
			{
				$notification = array("type" => "error","message" => "Les mots de passes ne correspondent pas !");
			}
		}
		else
		{
			$notification = array("type" => "error","message" => "Veuillez remplir tous les champs !");
		}
	}
	else
	{
		$notification = array("type" => "error","message" => "Veuillez acceptez les cgu !");
	}
}
?>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="style.css" /> 
	<title>SweetHouse | Inscription</title>
</head>
<body>
	<?php include 'header.php' ?>
	<?PHP include 'notification.php' ?>
	<div id="form-container">
		<form method="POST">
			<h2 id="title">Inscription</h2>
			<hr>
			<div class="input-group">
				<label for="lastName">Nom:</label>
				<input type="text" name="lastName" value="test">
			</div>

			<div class="input-group">
				<label for="nom">Prénom:</label>
				<input type="text" name="firstName" value="test">
			</div>

			<div class="input-group">
				<label for="password">Mot de passe :</label>
				<input type="password" name="password" value="test">
			</div>

			<div class="input-group">
				<label for="password2">Répetez mot de passe :</label>
				<input type="password" name="password2" value="test">
			</div>

			<div class="input-group">
				<label for="gender">Genre :</label>
				<select name="gender">
					<option>Homme</option>
					<option>Femme</option>
				</select>
			</div>

			<div class="input-group">
				<label for="type">Type :</label>
				<select name="type">
					<option>Particulier</option>
					<option>Professionel</option>
				</select>
			</div>

			<div class="input-group">
				<label for="email">Adresse email :</label>
				<input type="email" name="email" value="test@test.fr">
			</div>

			<div class="input-group">
				<label for="phone">Numéro de télephone:</label>
				<input type="phone" name="phone" value="014854848">
			</div>

			<div class="input-group">
				<label for="adress">Adresse :</label>
				<input type="text" name="adress" value="tsrezzzz">
			</div>

			<div class="input-group">
				<label for="zipCode">Code postal :</label>
				<input type="number" name="zipCode" value="75014">
			</div>

			<div class="input-group">
				<label for="city">Ville :</label>
				<input type="text" name="city" value="paris">
			</div>

			<div class="input-group">
				<label for="country">Pays :</label>
				<input type="text" name="country" value="france">
			</div>
			<div class="input-group">
				<label for="cgu">Acceptez les CGU :</label>
				<input type="checkbox" name="cgu">
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