<?php

//Require Database Connection Script
require 'dbconnect.php';

//Start User Session
session_start();

//Grab UsersId From Session
$sessionId = $_SESSION["usersId"];

//Check Proper Form Action
if (isset($_POST["upload"]))
{
	//echo "Form Action Success";
	
	//Grab File Data
	$file = $_FILES["file"];
	$fileName = $_FILES["file"]["name"];
	$filePathName = $_FILES["file"]["tmp_name"];
	$fileSize = $_FILES["file"]["size"];
	$fileError = $_FILES["file"]["error"];
	$fileType = $_FILES["file"]["type"];
	
	//Grab File Extension
	$fileSplit = explode(".", $fileName);
	$fileExt = strtolower(end($fileSplit));
	
	//Allow Image Formats
	$allow = array("jpg", "jpeg", "png");
	
	//Check File Extension
	if (in_array($fileExt, $allow))
	{
		//Check For Upload Error
		if ($fileError == 0)
		{
			//Limit File Size To 10 MB
			if ($fileSize < 10000000)
			{
				//Rename File With Unique Name
				$fileNameUser = "account-" .$sessionId. ".".$fileExt;

				//Get Website Uploads Path
				$filePathDes = dirname(__DIR__ , 1) ."/uploads/".$fileNameUser;

				//Upload File To Source Folder
				move_uploaded_file($filePathName, $filePathDes);

				//Add Custom Image To Database
				$sql = "UPDATE users SET usersImg=1 WHERE usersId='$sessionId';";

				//Update Database
				mysqli_query($dbc, $sql);
				
				//Update Session Variable
				$_SESSION["usersImg"] = 1;
				
				//Send User Back To Account Page
				header("location: ../account.php?error=none");
				exit();
			}
			else
			{
				//Send User Back To Account Page
				header("location: ../account.php?error=size");
				exit();
			}
		}
		else
		{
			//Send User Back To Account Page
			header("location: ../account.php?error=upload");
			exit();
		}
	}
	else
	{
		//Send User Back To Account Page
		header("location: ../account.php?error=type");
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