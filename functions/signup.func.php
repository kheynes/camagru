<?php
	include "sendmail.func.php";
	
    if (isset($_POST['signup-submit'])){
		$username = $_POST['username'];
		$email = $_POST['email'];
		$passwd = $_POST['passwd'];
		$pwd_repeat = $_POST['passwd-repeat'];
		$pic = file_get_contents("../styles/default.jpg");
		$con = new PDO ("mysql:host=localhost;dbname=camagru", "root", "roooot");
		
		$doesexist = $con->prepare("SELECT * FROM `users` WHERE username = ? OR email = ?");
		$doesexist->execute([$username, $email]);
		$d = $doesexist->rowCount();
		if(empty($username) || empty($email) || empty($passwd) || empty($pwd_repeat) || !(isset($_POST['tos']))) {
			// print_r($_POST);
			header("location: ../signup.php?error=emptyfield&uid=".$username."&mail=".$email);
			exit();
		}
		else if (!preg_match("/^[a-zA-Z0-9_]*$/", $username)){
			header("location: ../signup.php?error=username&mail=".$email);
			exit();
		}
		else if ($passwd !== $pwd_repeat) {
			header("location: ../signup.php?error=password&uid=".$username."&mail=".$email);
			exit();
		}
		else if (!preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $passwd) || strlen($passwd) < 8)
		{
			header("location: ../signup.php?error=passwordnotsecure&uid=".$username."&mail=".$email);
			exit();
		}
		else if($d > 0){
			header("location: ../signup.php?error=userexists&uid=".$username."&mail=".$email);
			exit();
		}
		else{
			$token = hash('whirlpool',$username);
        	try
        	{
        	    // echo "nanannananana";
        	    // print_r($_POST);
				// Why you under the table, Matthew? 
        	    $insert = $con->prepare("INSERT INTO users (email,username,`password`,picturesource,token) values(:email,:username,:passwd,:pic,:token)");
              
        		$insert->bindParam(':email',$email);
        		$insert->bindParam(':username',$username);
				$insert->bindParam(':passwd',hash('whirlpool',(hash('whirlpool',$passwd))));
				$insert->bindParam(':pic',$pic);
				$insert->bindParam(':token',$token);
				
            	$insert->execute();
        	}
        	catch(PDOException $e)
        	{
				echo "Error".$e->getMessage();
			}
			$body = '
			<html>
			<head>
			  <title>Verify your account</title>
			</head>
			<body>
			  <a href="http://localhost:8080/camagru/verify.php?verify='.$token.'">Click here to verify account</a>
			</body>
			</html>';
			sendmailverify($email, $body, $token);
			// mail($email,"verify","dfas","das");
			header("location: ../index.php");
		}
	}
?> 