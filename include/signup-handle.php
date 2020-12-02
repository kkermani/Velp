<?php

//Require Database Connection Script
require 'dbconnect.php';

//Check Proper Form Action
if (isset($_POST["signup"]))
{
	//echo "Form Action Success";
	
	//Grab Form Data
	$name = $_POST["name"];
	$dob = $_POST["dob"];
	$username = $_POST["uid"];
	$email = $_POST["email"];
	$pwd = $_POST["pwd"];
	$pwdconfirm = $_POST["pwdconfirm"];
	
	//Require Functions Script
	require_once 'functions.php';

	//Error Handling
	if (emptyInputSignup($name, $dob, $username, $email, $pwd, $pwdconfirm) !== false)
	{
		//Send User Back To Sign Up Form
		header("location: ../signup.php?error=emptyinput");
		exit();
	}

	if (tooYoung($dob) !== false)
	{
		//Send User Back To Sign Up Form
		header("location: ../signup.php?error=tooyoung");
		exit();
	}
	
	if (invalidUid($username) !== false)
	{
		//Send User Back To Sign Up Form
		header("location: ../signup.php?error=invaliduid");
		exit();
	}
	
	if (invalidEmail($email) !== false)
	{
		//Send User Back To Sign Up Form
		header("location: ../signup.php?error=invalidemail");
		exit();
	}
	
	if (pwdMatch($pwd, $pwdconfirm) !== false)
	{
		//Send User Back To Sign Up Form
		header("location: ../signup.php?error=pwdnomatch");
		exit();
	}
	
	if (userExists($dbc, $username, $email) !== false)
	{
		//Send User Back To Sign Up Form
		header("location: ../signup.php?error=userexists");
		exit();
	}
	
	//Create New User In Database
	createUser($dbc, $name, $dob, $username, $email, $pwd);
}
else
{
	//Send User Back To Sign Up Form
	header("location: ../signup.php");
	exit();
}

?>