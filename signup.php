<?php 
session_start();

if(isset($_SESSION['user'])) {
	header('location: profile.php');
}

require('app/ini.inc.php');

require(INCLUDES_PATH . '/funcs.inc.php');
require(CLASSES_PATH . '/database.class.php');

$database = Database::ini(HOST, DB_NAME, DB_USER, DB_PASSWORD);

$data = $_POST;
$message = [
	'errorCode' => -1,
	'textMessage' => ''
];

$values = ['btnRegister', 'cin', 'nom', 'email', 'prenom', 'pass', 'datenaiss'];

if(inArray($values, $data)) {
	require(INCLUDES_PATH . '/signup.inc.php');
}
?> 
 <!DOCTYPE html>
<html>
<head>
	<title>Signin</title>

	<link rel="stylesheet" type="text/css" href="./assets/css/appcss.css">
</head>
<body class="login-body">
	<div class="login-div">
	<div class="logo" style="height: 15%">
	<a href="./index.php"><img src="./assets/img/logo1.png" style="width: 100%;"></a>
	</div>
	<hr>
	<div style="height: 15%">
		<p class="login-hello">
			<span class="login-hello-span">Iscrivez-vous</span><br><br><p class="message"> et lancer votre projet vers le digital.</p>
		</p>
	</div> 
	<img src="">
	<hr>
		<form  action="#" method="POST">
			<label>
				<?php
				if($message['errorCode'] != -1) {
					echo ($message['textMessage']);
				}
				?>
			</label>
			
			<input class="login-input" placeholder="CIN" type="text" name="cin"  required >
			<input class="login-input" placeholder="Nom" type="text" name="nom" required>
			<input class="login-input" placeholder="Prenom" type="text" name="prenom"  required>
			<input class="login-input" placeholder="E-Mail" type="text" name="email"  required>
			<input class="login-input" placeholder="Mot de passe" type="password" name="pass"  required>
			<input class="login-input" type="date" name="datenaiss" required>
			<input class="sub" type="Submit" name="btnRegister">
		</form>
		<div class="deja-inscrit">
		Vous avez deja un compte?  <a class="deja-inscrit-link" href="./signin.php">Se connecter</a>
		</div>
	</div>
</body>
</html>