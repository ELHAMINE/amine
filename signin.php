<?php
session_start();

$user = $_SESSION['user'] ?? null;

$message = [
	'errorCode' => -1,
	'textMessage' => '',
	'isAdmin' => false
];

if($user != null) {
	$user = json_decode($user);
	if($user->is_active == '0' || $user->is_active == null) {
		$message['errorCode'] = 0;
		$message['textMessage'] = "Votre compte n'est pas activé!";
	}
	else {
		if($user->is_admin == '1')
			header('location: admin/index.php');
		else
			header('location: profile.php');
	}
}

require_once('app/ini.inc.php');
require_once(CLASSES_PATH . '/database.class.php');

$database = Database::ini(HOST, DB_NAME, DB_USER, DB_PASSWORD);

$data = $_POST;

if(isset($data['btnLogin'])) {
	// the variable $data are used in this file!
	require(INCLUDES_PATH . '/signin.inc.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="./assets/css/appcss.css" />
</head>
<body class="login-body">
	<div class="signin-div">
		<div class="logo" style="height: 15%;">
			<a href="./index.php"><img src="./assets/img/logo1.png" style="width: 100%; height: 150%;"></a>
		</div>
		<hr>
		 <div style="height: 15%">
			<p class="login-hello">
				<span class="signin-hello-span">Log In</span><br><br>	
			</p>	
		</div> 
		<img src="">
		<hr>
		<label>
			<?php
			if($message['errorCode'] != -1) {
				echo ($message['textMessage']);
				if($message['errorCode'] == 1) {
					if($message['isAdmin'] === true)
						header('location: admin/index.php');
					else
						header('location: profile.php');
				}
			}
			?>
		</label>
		<form action="#" method="POST">
			<br/>
			<input class="login-input" placeholder="E-Mail" type="text" name="email">
			<input class="login-input" placeholder="Mot de passe" type="password" name="password">
			<br />
			<br />
			<input class="sub" type="Submit" name="btnLogin">
		</form>
		<div class="deja-inscrit-signin">
			Vous n'avez pas un compte? <a class="deja-inscrit-link" href="./signup.php"><u>S'inscrire</u></a>
		</div>
	</div>
</body>
</html>