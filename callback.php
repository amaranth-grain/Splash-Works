<?php
	session_start();

	if (isset($_GET['error'])) {
		header('Location: login.php');
		exit();
	}

	require "InstagramAPI.php";

	$data = $Instagram->getAccessTokenAndUserDetails($_GET['code']);

	$_SESSION['username'] = $data['user']['id'];
	$_SESSION['loggedIn'] = 1;
	$_SESSION['instagram_msg'] = "";
	// $_SESSION['accessToken'] = $data['access_token'];
	// $_SESSION['id'] = $data['user']['id'];
	// $_SESSION['username'] = $data['user']['username'];
	// $_SESSION['bio'] = $data['user']['bio'];
	// $_SESSION['website'] = $data['user']['website'];
	// $_SESSION['fullName'] = $data['user']['full_name'];
	// $_SESSION['profilePicture'] = $data['user']['profile_picture'];


	require "php/connectDB.php";

	if(empty(trim($_SESSION["username"]))){
        $_SESSION['instagram_msg'] = "Instagram API no username.";
    } else{
		$username = $_SESSION["username"];

        // Prepare a select statement
        $check = "SELECT id FROM users WHERE username = :username";
		
        $check_stmt = $pdo->prepare($check);
		$check_stmt->bindParam(':username', $username, PDO::PARAM_STR);
		
		if($check_stmt->execute()){
			if($check_stmt->rowCount() == 1){
				$_SESSION['instagram_msg'] = "This username already exists.";
			} else{
				
				$create = "INSERT INTO users (username) VALUES (:username)";
				$create_stmt = $pdo->prepare($create);
				$create_stmt->bindParam(':username', $username, PDO::PARAM_STR);
				if($create_stmt->execute()){
					$_SESSION['instagram_msg'] = "New account just created.";
				} else{
					$_SESSION['instagram_msg'] = "Something went wrong when creating new account.";
				}
			}
		} else{
			$_SESSION['instagram_msg'] = "Something went wrong when checking user.";
		}
	}
	
	header('Location: index.php');
	exit();

?>