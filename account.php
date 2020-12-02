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
			Account Page
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
					if ($_GET["error"] == "size")
					{
					echo "<p>Image is too large to upload!</p>";
					}
					else if ($_GET["error"] == "type")
					{
					echo "<p>Please upload a supported image file format!</p>";
					}
					else if ($_GET["error"] == "upload")
					{
					echo "<p>Something went wrong! Please try again later.</p>";
					}
					else if ($_GET["error"] == "delete")
					{
					echo "<p>Something went wrong! Please try again later.</p>";
					}
					else if ($_GET["error"] == "filenotfound")
					{
					echo "<p>Could not find image to delete!</p>";
					}
					else if ($_GET["error"] == "invaliduid")
					{
					echo "<p>Usernames can not contain symbols or spaces!</p>";
					}
					else if ($_GET["error"] == "pwdnomatch")
					{
					echo "<p>Passwords do not match!</p>";
					}
					else if ($_GET["error"] == "userexists")
					{
					echo "<p>User already exists!</p>";
					}
					else if ($_GET["error"] == "sqlfail")
					{
					echo "<p>Something went wrong! Please try again later.</p>";
					}
					else if ($_GET["error"] == "none")
					{

					}
				}
			?>
			
		</div>

		<?php

			//Check For Logged In User
			if (isset($_SESSION["usersId"]))
			{
				//Grab UsersId From Session
				$sessionId = $_SESSION["usersId"];
				
				echo '
				<div class="container">

					<div class="profile-header">

						<div class="profile-img">';
						
							//Check For Profile Image
							if ($_SESSION["usersImg"] == 0)
							{
								echo'<img src="uploads/account-default.png" width="200" alt="Profile Image">';
							}
							else
							{
								//Grab File Extension
								$fileName = "uploads/account-" .$sessionId;
								$fileMatch = glob($fileName . ".*");

								$fileInfo = pathinfo($fileMatch[0]);
								$fileExt = $fileInfo['extension'];
					
								echo'<img src="uploads/account-'.$_SESSION["usersId"].'.'.$fileExt.'?'.mt_rand().'" width="200" alt="Profile Image">';
							}

						echo '
						</div>

						<div class="profile-nav-info">

							<h1 class="user-name">'.$_SESSION["usersUid"].'</h1>

							<div class="name">
								<p>'.$_SESSION["usersName"].'</p>
							</div>

						</div>

					</div>';
					
					echo '
					<div class="main-bd">

						<div class="left-side">

							<div class="profile-side">

								<div class="user-bio">
									<h3>Bio</h3>

									<p>Hi! I am a Velp user and I love movies! Check out my reviews!</p>

									<p class="user-mail"><i class="fa fa-user-circle"></i>'.$_SESSION["usersDOB"].'</p>
									<p class="user-mail"><i class="fa fa-envelope"></i>'.$_SESSION["usersEmail"].'</p>

								</div>

								<form class="profile-btn" action="include/delete-handle.php" method="post" enctype="multipart/form-data">
									<button type="submit" class="Editbtn" name="delete">Delete Image</button>
								</form>

							</div>


						</div>';
						
						echo '
						<div class="right-side">
							<div class="nav">
								<ul>

								<li onclick="tabs(0)" class="user-review active">Reviews</li>
								<li onclick="tabs(1)" class="user-setting">Settings</li>

								</ul>
							</div>';
							
							echo '
							<div class="profile-body">
							
								<div class="profile-reviews tab">
								
									<h1>Your Reviews</h1>';
									
									echo"<p>You don't have any reviews yet.</p>
								
								</div>";

								echo '
								<div class="profile-settings tab">
									<h1>Account Settings</h1>
									
									<form class="profile-btn profile-form" action="include/upload-handle.php" method="post" enctype="multipart/form-data">
									
										<input type="file" id="file" name="file">
										
										<button type="submit" class="Editbtn" name="upload">Upload Image</button>
									</form>

									<form class="profile-form" action="include/update-handle.php" method="post">

										<div class="field">
											<label for="name">Name</label>
											<input type="text" id="name" name="name" placeholder="Enter your name">
										</div>

										<div class="field">
											<label for="uid">Username</label>
											<input type="text" id="uid" name="uid" placeholder="Enter username">
										</div>

										<div class="field">
											<label for="pwd">Password</label>
											<input type="password" id="pwd" name="pwd" placeholder="Enter Password">
										</div>
										
										<div class="field">
											<label for="pwd">Confirm Password</label>
											<input type="password" id="pwdconfirm" name="pwdconfirm" placeholder="Confirm password">
										</div>
										
										<button type="submit" class="Button log-Button" name="submit">Update Info</button>
										
									</form>

								</div>
								
							</div>
						</div>
						
					</div>
					
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

		<!--Javascript-->
		<script src="./js/jquery.js"></script>
		<script src="./js/main.js"></script>

	</body>
</html>