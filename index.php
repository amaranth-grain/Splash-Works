<?php

    require "InstagramAPI.php";
    session_start();
    if(isset($_SESSION['username'])){
        header("location: levelmenu.php");
    } 

    include "php/connectDB.php";

 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = 'Please enter username.';
    } else{
        $username = trim($_POST["username"]);
        //save username in cookies
        setcookie('username', $username, time()+3600);
    }
    
    // Check if password is empty
    if(empty(trim($_POST['password']))){
        $password_err = 'Please enter your password.';
    } else{
        $password = trim($_POST['password']);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT username, password FROM users WHERE username = :username";
        
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(':username', $param_username, PDO::PARAM_STR);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Check if username exists, if yes then verify password
                if($stmt->rowCount() == 1){
                    if($row = $stmt->fetch()){
                        $hashed_password = $row['password'];
                        if(password_verify($password, $hashed_password)){
                            /* Password is correct, so start a new session and
                            save the username to the session */
                            session_start();
                            $_SESSION['username'] = $username;      
                            header("location: levelmenu.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = 'The password you entered was not valid.';
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = 'No account found with that username.';
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        unset($stmt);
    }
    
    // Close connection
    unset($pdo);
}
?>


<!DOCTYPE html>

    <html lang="en">
        
        <head>
            <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1"/>
            <link href="./design/style3a.css" rel="stylesheet" type="text/css" media="all" />
            <link href="./images/favicon.ico" rel="shortcut icon" type="image/png" />
        </head>
        
        <body>
            
            <div class="padding-all">
                <div class="navBar"><img src="./images/splash-works-logo2.png" title="logo" alt="splashWorksLogo" id="biglogo">
                <img id="logo" src="./images/logo270.png" usemap="#image-map">
                <map name="image-map">
                    <area id="testLink" alt="Hello there!" href="#" coords="60,53,10" shape="circle">
                </map>
                </div>
                <div class="logo"><img id="logoImage" src="./images/opifex2.png" usemap="#image-map"/></div>
                
                <map name="image-map">
                    <area target="_blank" alt="Never gonna give you up." title="Never gonna give you up." href="http://opifex.ca/music/rickroll.mp3" coords="76,138,56,120" shape="rect">
                </map>
                
                <div class="header">
                    <h1>Login</h1>
                </div>
                <div class="container"></div>
                    <div class="mainForm">
                        <div class="innerForm">
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                              <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                                <input name="username" id="name" autofocus="autofocus" placeholder="Username" required="required" type="text" value="<?php echo isset($_POST['username']) ? $_POST['username'] : '' ?>" />
                                <br><span class="tip"><?php echo $username_err; ?></span>
                              </div>
                              <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                                <input class="padding" name="password" id="password" placeholder="Password" required="required" type="password"/>
                                <br><span class="tip"><?php echo $password_err; ?></span>
                              </div>                            
                                <input id="submit" name="submit" type="submit" value="Login"/>
                            </form>
                            <div class="footer">
                            <p><a href="signup.php">Signup for free</a></p>
                            <a href="<?php echo $Instagram->getLoginURL() ?>"><img id="instagram" src="./images/instagram.png"/></a>
                                
                            </div>
                        </div>
                        <div class="clear">
                        </div>
                    </div>
                    <div class="content">
                        <p class="doge" id="doge1">many splash</p>
                        <p class="doge" id="doge2">so works</p>
                        <p class="doge" id="doge3">wow</p>
                        <p class="doge" id="doge4">very game</p>
                        <img class="doge" id="dogePic" src="./images/doge.png"/>
                        <!--<img id="logo" src="./img/logo.png" usemap="#image-map">
                            <map name="image-map">
                                <area target="" id="testLink" alt="Hello there!" href="#" coords="83,72,4" shape="circle">
                            </map>
                        <img id="dogePic2" src="./img/doge.png"/>-->
                    </div>
                </div>
            <script src="jquery-3.3.1.min.js"></script>
            <script type="text/javascript" src="./dynamics/login.js"></script>  
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
            <script type="text/javascript" src="./dynamics/jQueryRotate.js"></script>
            <script type="text/javascript" src="./dynamics/easter.js"></script>
        </body>
    
    </html>

    

<?php
    if(isset($_COOKIE['username'])){
        $previous_username = $_COOKIE['username'];
        
        echo "<script>
            document.getElementById('name').value = '$previous_username';
        </script>";
    }
?>