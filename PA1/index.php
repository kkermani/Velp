<!DOCTYPE html>
<html lang="en">
<head>
<title>
Create an account
</title>
<meta charset="utf-8">

	<!--Viewport-->
	<meta name = "viewport" content = "width=device-width, initial-scale=1.0">

    <title>Form</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	
	<link href="css/normalize.css" rel="stylesheet">
	<link href="css/fonts.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    
</head>

<body>

<!--Navigation-->
<div class="topnav">

	<a href="home.php" class="logo">
		<img src="img/logo.png" width="75" height="75" alt="Website Logo">
	</a>

	<div class="topnavlist">
		<a class="topnavbtn" href="home.php">Home</a>
		<a class="topnavbtn" href="index.php">Account</a>
	</div>  
</div>


<!--wrapping the webpage in php-->
<?php
echo '
<div class="container">
    <h2>Sign Up</h2>
    <form action="handle.php" method="post">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="name" class="form-control" id="name" placeholder="Enter your name" name="name">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
        </div>
        <div class="form-group">
            <label for="pwd">Password:</label>
            <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd">
        </div>
		
		<div class="filterBtn">
			<button type="submit" class="btn btn-default">Submit</button>
		</div>
    </form>
</div>
';
?>
</body>
</html>