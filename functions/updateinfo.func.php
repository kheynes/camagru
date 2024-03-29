<?php
	session_start();
	if (isset($_POST["change-submit"])){
		if (!isset($_POST['email']) || !isset($_POST['username'])){
			header("location: ../changeDetails.php?error=emptyfield");
			exit();
		}
		$username = $_POST['username'];
		$email = $_POST['email'];
		if (isset($_POST['notifications'])){
			$check = 2;
		}
		else{
			$check = 1;
		}
		$con = new PDO ("mysql:host=localhost;dbname=camagru", "root", "roooot");
		$doesexist = $con->prepare("SELECT * FROM `users` WHERE username = :user OR email = :mail");
		$doesexist->bindParam(':user',$username);
		$doesexist->bindParam(':mail',$email);
		$doesexist->execute();
		$d = $doesexist->rowCount();

		$doesexist->setFetchMode(PDO::FETCH_ASSOC);
		
		$data = $doesexist->fetch();
		// echo($username);
		// print_r($_SESSION);
		if ($d != 1 || $data['id'] != $_SESSION['id']){
			header("location:../changeDetails.php?error=userexists");
			exit();
		}
		try
	    {
		
			$update = $con->prepare("UPDATE `users` SET `username` = :user, email = :mail, verified = :note WHERE `users`.`id` =:id ");
			$update->bindParam(':user', $username);
			$update->bindParam(':mail', $email);
			$update->bindParam(':note', $check);
			$update->bindParam(':id', $_SESSION['id']);
			$update->execute();
			$_SESSION['email'] = $email;
			$_SESSION['username'] = $username;
			$_SESSION['verified'] =  $check;
			
			header("location:../changeDetails.php");

		}
		catch(PDOException $e)
		{
			echo "Error".$e->getMessage();
		}
	}