<?php

if(isset($_POST['Sumbit']))
{
	include_once 'dbh.inc.php';

	$cni=mysqli_real_escape_string($conn, $_POST['CNI']);
	$name=mysqli_real_escape_string($conn, $_POST['name']);
	$Prenom=mysqli_real_escape_string($conn, $_POST['Prenom']);
	$Mail=mysqli_real_escape_string($conn, $_POST['Mail']);
	$passwd=mysqli_real_escape_string($conn, $_POST['passwd']);
	$passwd2=mysqli_real_escape_string($conn, $_POST['passwd2']);
	$date=mysqli_real_escape_string($conn, $_POST['date']);

	if(!preg_match("/^[a-zA-Z]*$/", $name) || !preg_match("/^[a-zA-Z]*$/", $Prenom)|| !preg_match("/^[a-zA-Z]*$/", $Mail))
		{
		header("Location: ../../signin.php?signup=invalid");
		exit();
		}else
		{
			if(!filter_var($Mail, FILTER_VALIDAE_EMAIL))
			{
				header("Location: ../../signin.php?signin=email");
				exit();
			}
			else
			{
				$sql = "SELECT * FROM utilisateur WHERE cni='$cni'";
				$result = mysqli_query($conn, $sql);
				$resultCheck = mysqli_num_rows($result);

				if($resultCheck > 0) 
				{
					header("Location: ../../signin.php?signin=usertaken");
				exit();
				}
				else
				{
					$hashedpw = password_hash($passwd, PASWWORD_DEFAULT);
					$sql = "INSERT INTO utilisateur (cniutilisateur, motdepass, nom, prenom, datenaiss, email) VALUES ('$cni', '$passwd', '$name','$prenom', '$date', '$email')";
					mysqli_query($conn, $sql);

					header("Location: ../../signin.php?signin=success");
				exit();
				}
			}
		}





}
else
{
	header("location: ../../signin.php");
	exit();
}