<?php

//Require Database Connection Script
require 'dbconnect.php';

//Start User Session
session_start();

//Grab UsersId From Session
$sessionId = $_SESSION["usersId"];

//Check Proper Form Action
if (isset($_POST["submit"]))
{
	//echo "Form Action Success";
	
	//Grab Form Data
	$name = $_POST["name"];
	$username = $_POST["uid"];
	$pwd = $_POST["pwd"];
	$pwdconfirm = $_POST["pwdconfirm"];
	
	//Require Functions Script
	require_once 'functions.php';

	//Error Handling
	if (emptyInputUpdate($name, $username, $pwd, $pwdconfirm) !== false)
	{
		//Send User Back To Account Page
		header("location: ../account.php?error=emptyinput");
		exit();
	}
	
	if (invalidUid($username) !== false)
	{
		//Send User Back To Account Form
		header("location: ../account.php?error=invaliduid");
		exit();
	}
	
	if (pwdMatch($pwd, $pwdconfirm) !== false)
	{
		//Send User Back To Account Page
		header("location: ../account.php?error=pwdnomatch");
		exit();
	}
	
	if (userExists($dbc, $username, $username) !== false)
	{
		//Send User Back To Account Page
		header("location: ../account.php?error=userexists");
		exit();
	}
	
	//Update User Info In Database
	updateUser($dbc, $sessionId, $name, $username, $pwd, $pwdconfirm);
}
else
{
	//Send User Back To Account Page
	header("location: ../account.php");
	exit();
}

?>