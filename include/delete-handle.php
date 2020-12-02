<?php

//Require Database Connection Script
require 'dbconnect.php';

//Start User Session
session_start();

//Grab UsersId From Session
$sessionId = $_SESSION["usersId"];

//Check Proper Form Action
if (isset($_POST["delete"]))
{
	//echo "Form Action Success";
	
	//Get File Path To Delete
	$filePath = dirname(__DIR__ , 1) ."/uploads/account-" .$sessionId. ".*";

	//Match Name With File
	$fileMatch = glob($filePath);
	
	//Check For File Match
	if (!empty($fileMatch))
	{
		//Grab File Extension
		$fileSplit = explode(".", $fileMatch[0]);
		$fileExt = strtolower(end($fileSplit));
		
		//Get Full File Path
		$filePathName = dirname(__DIR__ , 1) ."/uploads/account-" .$sessionId. ".".$fileExt;
		
		//Check For Deletion Error
		if (!unlink($filePathName))
		{
			//Send User Back To Account Page
			header("location: ../account.php?error=delete");
			exit();
		}
		else
		{
			//Delete File
			
			//Remove Custom Image From Database
			$sql = "UPDATE users SET usersImg=0 WHERE usersId='$sessionId';";
			
			//Update Database
			mysqli_query($dbc, $sql);

			//Update Session Variable
			$_SESSION["usersImg"] = 0;

			//Send User Back To Account Page
			header("location: ../account.php?error=none");
			exit();
			
		}	
	}
	else
	{
		//Send User Back To Account Page
		header("location: ../account.php?error=filenotfound");
		exit();
	}
}
else
{
	//Send User Back To Account Page
	header("location: ../account.php");
	exit();
}

?>