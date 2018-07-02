<?php
require('app/ini.inc.php');
require_once(CLASSES_PATH . '/database.class.php');

$database = Database::ini(HOST, DB_NAME, DB_USER, DB_PASSWORD);

if(isset($_POST['btnSend'])) {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $database->nonQuery('INSERT INTO Contact VALUES (NULL, ?, ?, ?)', [
        $nom, $email, $message
    ]);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>NEXLAB</title>
	<link rel="stylesheet" type="text/css" href="./assets/css/contact.css" />
</head>
<body class="contact-body">
        <header>
                <div class="nav">
                  <ul>
                    <li class="home"><a href="index.php">Home</a></li>
                    <li class="services"><a href="services.php">Services</a></li>
                    <li class="connexion"><a href="signin.php">Connexion</a></li>
                    <li class="Inscription"><a href="signup.php">Inscription</a></li>
                    <li class="contact"><a href="contacter.php">Contacter nous</a></li>
                  </ul>
                </div>
              </header>



    
            <div class="contact-title">
                <h1>CONTACTER NOUS</h1>
               <h2>On est toujours fiere de vous servire !!! </h2> 
            </div>

            <div class="contact-form">

                <form id="contact-form" method="POST" action="">
                    <input type="text" name="nom" class="form-control" placeholder="Nom" required/><br>
                    <input type="text" name="email" class="form-control" placeholder="Email OU votre nom et prenom" required/><br>
                    <textarea class="form-control" name="message"  cols="30" rows="4" placeholder="Message" required/></textarea><br>
                    <input type="submit" name="btnSend" class="form-control submit" value="ENVOYER"/>
                </form>
            </div>

    
</div>
</body>
</html>