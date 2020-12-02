<?php

//Require Database Connection Script
require_once 'dbconnect.php';

//Start User Session
session_start();

?>

<!--Navigation-->
<div class="header">
	<div class="navcontainer">
		<nav>
			<input id="nav-toggle" type="checkbox">
			
			<div class="logo logoCo">
				<a href="index.php" class="logoCo"><strong>VELP</strong></a>
			</div>
			
			<ul class="links">
				<li><a href="index.php">Home</a></li>
				<li><a href="browse.php">Browse</a></li>
			  
				<?php
				
					//Check For Logged In User
					if (isset($_SESSION["usersId"]))
					{
						echo'<li><a href="favorites.php">Favorites</a></li>';
						
						echo'<li><a href="account.php">'.$_SESSION["usersUid"].'</a></li>';

						echo'<li><a href="include/logout-handle.php">Log Out</a></li>';
					}
					else
					{
						echo'<li><a href="signup.php">Log In / Sign Up</a></li>';
					}
				?>
				
			</ul>
			
			<label for="nav-toggle" class="icon-burger">
			  <span class=" c line"></span>
			  <span class=" c line"></span>
			  <span class=" c line"></span>
			</label>
		</nav>
	</div>
</div>