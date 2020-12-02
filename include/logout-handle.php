<?php

//Start User Session
session_start();

//Unset Session Variables
session_unset();

//Destroy User Session
session_destroy();

//Send User Back To Home Page
header("location: ../index.php");
exit();

?>