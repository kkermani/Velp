<?php

//Database Management Functions

//Create User
function createUser($dbc, $name, $dob, $username, $email, $pwd)
{	
	//Create SQL Query
	$sql = "INSERT INTO users (usersName, usersDOB, usersUid, usersEmail, usersPwd, usersImg) VALUES(?, ?, ?, ?, ?, ?);";
	
	//Initialize Prepared Statement
	$stmt = mysqli_stmt_init($dbc);
	
	//Check Statement Validity
	if (!mysqli_stmt_prepare($stmt, $sql))
	{
		//Send User Back To Sign Up Form
		header("location: ../signup.php?error=sqlfail");
		exit();
	}
	
	//Set Default Profile Image
	$defaultImg = 0;
	
	//Hash Password
	$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
	
	//Bind SQL Statement
	mysqli_stmt_bind_param($stmt, "sssssi", $name, $dob, $username, $email, $hashedPwd, $defaultImg);

	//Execute Statement
	mysqli_stmt_execute($stmt);

	//Get Statement Data
	$data = mysqli_stmt_get_result($stmt);

	//Close Prepared Statement
	mysqli_stmt_close($stmt);
	
	//Send User To Home Page
	header("location: ../signup.php?error=none");
}

//Login User
function loginUser($dbc, $username, $pwd)
{	
	//Fetch User Account Info
	$uidExists = userExists($dbc, $username, $username);
	
	//Check If User Exists
	if ($uidExists == false)
	{
		//Send User Back To Log In Form
		header("location: ../signup.php?error=wronglogin");
		exit();
	}
	
	//Fetch Hashed Password
	$hashedPwd = $uidExists["usersPwd"];
	
	//Verify Password Hash
	$checkPwd = password_verify($pwd, $hashedPwd);
	
	//Check For Correct Password
	if ($checkPwd == false)
	{
		//Send User Back To Log In Form
		header("location: ../signup.php?error=wronglogin");
		exit();
	}
	else if ($checkPwd == true)
	{
		//Start User Account Session
		session_start();
		$_SESSION["usersId"] = $uidExists["usersId"];
		$_SESSION["usersName"] = $uidExists["usersName"];
		$_SESSION["usersDOB"] = $uidExists["usersDOB"];
		$_SESSION["usersUid"] = $uidExists["usersUid"];
		$_SESSION["usersEmail"] = $uidExists["usersEmail"];
		$_SESSION["usersImg"] = $uidExists["usersImg"];
		
		//Send User To Home Page
		header("location: ../index.php");
		exit();
	}
}

//Update User
function updateUser($dbc, $id, $name, $username, $pwd)
{	
	//Check For Name Update
	if (!empty($name))
	{
		//Create SQL Query
		$sql = "UPDATE users SET usersName=? WHERE usersId=?;";

		//Initialize Prepared Statement
		$stmt = mysqli_stmt_init($dbc);
		
		//Check Statement Validity
		if (!mysqli_stmt_prepare($stmt, $sql))
		{
			//Send User Back To Sign Up Form
			header("location: ../account.php?error=sqlfail");
			exit();
		}
		
		//Bind SQL Statement
		mysqli_stmt_bind_param($stmt, "si", $name, $id);

		//Execute Statement
		mysqli_stmt_execute($stmt);

		//Get Statement Data
		$data = mysqli_stmt_get_result($stmt);

		//Close Prepared Statement
		mysqli_stmt_close($stmt);
		
		//Update Session Variable
		$_SESSION["usersName"] = $name;
	}
	
	//Check For Username Update
	if (!empty($username))
	{
		//Create SQL Query
		$sql = "UPDATE users SET usersUid=? WHERE usersId=?;";

		//Initialize Prepared Statement
		$stmt = mysqli_stmt_init($dbc);
		
		//Check Statement Validity
		if (!mysqli_stmt_prepare($stmt, $sql))
		{
			//Send User Back To Account Page
			header("location: ../account.php?error=sqlfail");
			exit();
		}
		
		//Bind SQL Statement
		mysqli_stmt_bind_param($stmt, "si", $username, $id);

		//Execute Statement
		mysqli_stmt_execute($stmt);

		//Get Statement Data
		$data = mysqli_stmt_get_result($stmt);

		//Close Prepared Statement
		mysqli_stmt_close($stmt);
		
		//Update Session Variable
		$_SESSION["usersUid"] = $username;
	}
	
	//Check For Password Update
	if (!empty($username))
	{
		//Create SQL Query
		$sql = "UPDATE users SET usersPwd=? WHERE usersId=?;";

		//Initialize Prepared Statement
		$stmt = mysqli_stmt_init($dbc);
		
		//Check Statement Validity
		if (!mysqli_stmt_prepare($stmt, $sql))
		{
			//Send User Back To Sign Up Form
			header("location: ../account.php?error=sqlfail");
			exit();
		}
		
		//Hash Password
		$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
		
		//Bind SQL Statement
		mysqli_stmt_bind_param($stmt, "si", $hashedPwd, $id);

		//Execute Statement
		mysqli_stmt_execute($stmt);

		//Get Statement Data
		$data = mysqli_stmt_get_result($stmt);

		//Close Prepared Statement
		mysqli_stmt_close($stmt);
	}

	//Send User To Home Page
	header("location: ../account.php?error=none");
}




//Error Validation Functions




//Empty Sign Up Form
function emptyInputSignup($name, $dob, $username, $email, $pwd, $pwdconfirm)
{
	//Create Result Boolean
	$result;
	
	//Check Fields
	if (empty($name) || empty($dob) || empty($username) || empty($email) || empty($pwd) || empty($pwdconfirm))
	{
		$result = true;
	}
	else
	{	
		$result = false;
	}

	return $result;
}

//Empty Log In Form
function emptyInputLogin($username, $pwd)
{
	//Create Result Boolean
	$result;
	
	//Check Fields
	if (empty($username) || empty($pwd))
	{
		$result = true;
	}
	else
	{	
		$result = false;
	}

	return $result;
}

//Empty Update Form
function emptyInputUpdate($name, $username, $pwd, $pwdconfirm)
{
	//Create Result Boolean
	$result;
	
	//Check Fields
	if (empty($name) && empty($username) && empty($pwd) && empty($pwdconfirm))
	{
		$result = true;
	}
	else
	{	
		$result = false;
	}

	return $result;
}

//Too Young
function tooYoung($dob)
{
	return false;
}

//Invalid Username
function invalidUid($username)
{
	//Create Result Boolean
	$result;
	
	//Check Username
	if (!preg_match("/^[a-zA-Z0-9]*$/", $username))
	{
		$result = true;
	}
	else
	{
		$result = false;
	}

	return $result;
}

//Invalid Email
function invalidEmail($email)
{
	//Create Result Boolean
	$result;
	
	//Check Username
	if (!filter_var($email, FILTER_VALIDATE_EMAIL))
	{
		$result = true;
	}
	else
	{
		$result = false;
	}

	return $result;
}

//Passwords Don't Match
function pwdMatch($pwd, $pwdconfirm)
{
	//Create Result Boolean
	$result;
	
	//Check Username
	if ($pwd !== $pwdconfirm)
	{
		$result = true;
	}
	else
	{
		$result = false;
	}

	return $result;
}

//User Already Exists
function userExists($dbc, $username, $email)
{
	//Create SQL Query
	$sql = "SELECT * FROM users WHERE usersUid = ? OR usersEmail = ?;";
	
	//Initialize Prepared Statement
	$stmt = mysqli_stmt_init($dbc);
	
	//Check Statement Validity
	if (!mysqli_stmt_prepare($stmt, $sql))
	{
		//Send User Back To Sign Up Form
		header("location: ../signup.php?error=sqlfail");
		exit();
	}
	
	//Bind SQL Statement
	mysqli_stmt_bind_param($stmt, "ss", $username, $email);
	
	//Execute Statement
	mysqli_stmt_execute($stmt);
	
	//Get Statement Data
	$data = mysqli_stmt_get_result($stmt);
	
	//Fetch Database Query
	if ($row = mysqli_fetch_assoc($data))
	{
		//Return Row Data
		return $row;
	}
	else
	{
		//Return False
		return false;
	}
	
	//Close Prepared Statement
	mysqli_stmt_close($stmt);
}

?>