<?php
// Include config file
//require_once 'config.php';
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'opifex.ca');
define('DB_USERNAME', 'admin_opifex');
define('DB_PASSWORD', 'whywhy');
define('DB_NAME', 'admin_opifex');
 
/* Attempt to connect to MySQL database */
try{
    $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
    die("ERROR: Could not connect. " . $e->getMessage());
}
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = :username";
        
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(':username', $param_username, PDO::PARAM_STR);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        unset($stmt);
    }
    
    // Validate password
    if(empty(trim($_POST['password']))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST['password'])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST['password']);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = 'Please confirm password.';     
    } else{
        $confirm_password = trim($_POST['confirm_password']);
        if($password != $confirm_password){
            $confirm_password_err = 'Password did not match.';
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
         
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(':username', $param_username, PDO::PARAM_STR);
            $stmt->bindParam(':password', $param_password, PDO::PARAM_STR);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                session_start();
                $_SESSION['username'] = $username;
                setcookie('username', $username, time()+3600);
                // Redirect to login page
                header("location: levelmenu.php");
            } else{
                echo "Something went wrong. Please try again later.";
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
            <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
            <link href="./design/style3b.css" rel="stylesheet" type="text/css" media="all" />
					  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
            <link href="./images/favicon.ico" rel="shortcut icon" type="image/png" />
        </head>
        
        <body>
            
            <div class="padding-all">
                <div class="navBar"><img id="signuplogo" src="./images/splash-works-logo2.png" title="logo" alt="splashWorksLogo"></div>
                <div class="logo"><img id="logoImage" src="./images/opifex2.png"/></div>
                <div class="header">
                    <h1>Sign up</h1>
                </div>
                <div class="mainForm">
                    <div class="innerForm">
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                              <input id="name" name="username" autofocus="autofocus" placeholder="Username" required="required" type="text"/>
                              <span class="tip"><?php echo $username_err; ?></span>
                            </div>
                            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                              <input id="password" class="padding" placeholder="Enter Password" required="required" name="password" type="password"/>
                              <span class="tip"><?php echo $password_err; ?></span>
                            </div>
                            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                              <input id="passwordConfirm" class="padding" placeholder="Re-enter Password" required="required" name="confirm_password" type="password"/>
                              <span id="confirmMessage" class="confirmMessage tip"><?php echo $confirm_password_err; ?></span>
                            </div>
														<input id="submit" name="submit" type="submit" value="Register"/>
                        </form>
                        <div class="footer">
                        <p><a href="index.php">Login here</a></p>
                        </div>
                        </div>
                    </div>
                    <div class="clear">
                    </div>
                </div>
                <div>
                    
                </div>
        <script type="text/javascript" src="./dynamics/login.js"></script>
        
        </body>
    
    </html>