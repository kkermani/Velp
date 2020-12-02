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
		<link href="css/profile.css" rel="stylesheet">
		<link href="css/browse.css" rel="stylesheet">
		<link href="css/main.css" rel="stylesheet">
		<link href="css/flexbox.css" rel="stylesheet">

		<title>
			Favorites
		</title>
		
	<head>

	<body>

		<!--Navigation-->
		<?php
			include_once "include/header.php";
		?>

		<div class="error">

		</div>

		<?php

			//Check For Logged In User
			if (isset($_SESSION["usersId"]))
			{
				echo '
				<div class="intro">

					<h1>Your Favorites</h1>
					<hr>
					<h2>Coming Soon (PA3)</h2>
				</div>';
			}
			else
			{
				echo '
				<div class="error">
					<p>Please log in to continue</p>
				</div>';
			}
		?>
		
		<!--Footer-->
		<?php
			include_once "include/footer.php";
		?>

	</body>

</html>