<!DOCTYPE html>

<html lang="en">

	<head>
		<!--Charset-->
		<meta charset="utf-8">
	
		<!--Viewport-->
		<meta name = "viewport" content = "width=device-width, initial-scale=1.0">

		<!--Icons-->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

		<!--Stylesheets-->
		<link href="css/normalize.css" rel="stylesheet">
		<link href="css/browse.css" rel="stylesheet">
		<link href="css/main.css" rel="stylesheet">
		<link href="css/flexbox.css" rel="stylesheet">

		<title>
			Log In Or Sign Up
		</title>
		
	<head>

	<body>

		<!--Navigation-->
		<?php
			include_once "include/header.php";
		?>

		<div class="error">

			<?php

				//Display Error Messages To User
				if (isset($_GET["error"]))
				{
					if ($_GET["error"] == "emptyinput")
					{
					echo "<p>Please fill in all fields!</p>";
					}
					else if ($_GET["error"] == "tooyoung")
					{
					echo "<p>You must be at least 13 years old to sign up!</p>";
					}
					else if ($_GET["error"] == "invaliduid")
					{
					echo "<p>Usernames can not contain symbols or spaces!</p>";
					}
					else if ($_GET["error"] == "invalidemail")
					{
					echo "<p>Please provide a valid email address!</p>";
					}
					else if ($_GET["error"] == "pwdnomatch")
					{
					echo "<p>Passwords do not match!</p>";
					}
					else if ($_GET["error"] == "userexists")
					{
					echo "<p>User already exists!</p>";
					}
					else if ($_GET["error"] == "wronglogin")
					{
					echo "<p>Incorrect username or password!</p>";
					}
					else if ($_GET["error"] == "sqlfail")
					{
					echo "<p>Something went wrong! Please try again later.</p>";
					}
					else if ($_GET["error"] == "none")
					{
					echo "<p>Thanks for signing up! You can now log in!</p>";
					}
				}
			?>
			
		</div>

		<div class="row">

			<!--Log In-->
			<div class="column">
			
				<h2>Log in to your account</h2>

				<form action="include/login-handle.php" method="post">
				
					<div class="field">
						<label for="uid">Username/Email</label>
						<input type="text" id="uid" name="uid" placeholder="Username/Email">
					</div>

					<div class="field">
						<label for="pwd">Password</label>
						<input type="password" id="pwd" name="pwd" placeholder="Password">
					</div>
					
					<button type="submit" class="Button log-Button" name="login">Log In</button>
					
				</form>
				
			</div>

			<!--Sign Up-->
			<div class="column">
				
				<h2>Don't have an account?</h2>
				
				<form action="include/signup-handle.php" method="post">

					<div class="field">
						<label for="name">Name</label>
						<input type="text" id="name" name="name" placeholder="Enter your name">
					</div>

					<div class="field">
						<label for="dob">Date Of Birth</label>
						<input type="date" id="dob" name="dob" placeholder="Enter yor date of birth">
					</div>

					<div class="field">
						<label for="uid">Username</label>
						<input type="text" id="uid" name="uid" placeholder="Enter username">
					</div>

					<div class="field">
						<label for="email">Email</label>
						<input type="text" id="email" name="email" placeholder="Enter email">
					</div>

					<div class="field">
						<label for="pwd">Password</label>
						<input type="password" id="pwd" name="pwd" placeholder="Enter Password">
					</div>
					
					<div class="field">
						<label for="pwd">Confirm Password</label>
						<input type="password" id="pwdconfirm" name="pwdconfirm" placeholder="Confirm password">
					</div>
					
					<button type="submit" class="Button log-Button" name="signup">Sign Up</button>
					
				</form>

			</div>
			
		</div>

		<!--Footer-->
		<?php
			include_once "include/footer.php";
		?>

	</body>
</html>