<?php

//Require Database Connection Script
require 'dbconnect.php';

//Check Proper Form Action
if (isset($_POST["login"]))
{
	//echo "Form Action Success";
	
	//Grab Form Data
	$username = $_POST["uid"];
	$pwd = $_POST["pwd"];
	
	//Require Functions Script
	require_once 'functions.php';

	//Error Handling
	if (emptyInputLogin($username, $pwd) !== false)
	{
		//Send User Back To Log In Form
		header("location: ../signup.php?error=emptyinput");
		exit();
	}

	//Log User In
	loginUser($dbc, $username, $pwd);
}
else
{
	//Send User Back To Log In Form
	header("location: ../signup.php");
	exit();
}

?>