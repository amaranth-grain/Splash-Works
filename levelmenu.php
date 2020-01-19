<?php
    session_start();
    if(isset($_SESSION['username'])){
		//echo $_SESSION['username'] . $_SESSION['id'];
		var_dump($_SESSION);
    } else {
        header("location: logout.php");
    }
    var_dump($_POST);
?>

<!DOCTYPE html>

    <html lang="en">
        
        <head>
					  <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
            <link href="./design/lmenu.css" rel="stylesheet" type="text/css" media="all" />
						<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js" type="text/javascript">
					  </script>
					  <script type="text/javascript" src="./dynamics/buttons.js"></script>
						<link href="./images/favicon.ico" rel="shortcut icon" type="image/png"/>
        </head>
        
        <body>
				
					<div id="header">
					<a href="./logout.php"><img src="./images/exit.png" title="Exit" alt="Exit" id="exit"></a>
					<a id="logo">Select Level</a>  
					</div>
					<div id="arrow-left"></div>
            <!--- TAKE THIS OUT
            <div id="api">
                <img src="<?php echo $_SESSION['profilePicture'] ?>">
                <p>Name: <?php echo $_SESSION['fullName']; ?></p>
            </div>      -->  
					<div class="center">
					  <div class="level">					  
							<div class="select" id="l1">
								<h2 class="text">1</h2>
								<img src="./images/star_low@2x.png" title="Star" alt="Star">
								<img src="./images/star_low@2x.png" title="Star" alt="Star">
								<img src="./images/star_low@2x.png" title="Star" alt="Star">
							</div>
					  </div>
					  <div class="level">
							<div class="select" id="l2">
								<h2 class="text">2</h2>
								<img src="./images/star_low@2x.png" title="Star" alt="Star">
								<img src="./images/star_low@2x.png" title="Star" alt="Star">
								<img src="./images/star_low@2x.png" title="Star" alt="Star">
							</div>
					  </div>	
					  <div class="level">
						  <div class="select" id="l3">
								<h2 class="text">3</h2>
								<img src="./images/star_low@2x.png" title="Star" alt="Star">
								<img src="./images/star_low@2x.png" title="Star" alt="Star">
								<img src="./images/star_low@2x.png" title="Star" alt="Star">
							</div>
					  </div>		
					</div>
					<div id="arrow-right"></div>
					<div id = chooseworld>
  					<span class="dot" id="world1"></span>
  					<span class="dot" id="world2"></span>
  					<span class="dot" id="world3"></span>
					</div>
					<audio controls loop autoplay hidden>
    				<source src="./music/level1.wav">
					</audio> 
			  </body>   
      </html>