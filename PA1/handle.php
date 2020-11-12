<?php
date_default_timezone_set("UTC");
$name = $_POST["name"];
//get rid of non-alphanumeric chars in email address to reuse as filename later on to write user info in
$email = preg_replace("/[^A-Za-z0-9 ]/", '', $_POST["email"]);
$pwd = $_POST["password"];
//content to be written to file
$content = $name . "\n" . $email . "\n" . $pwd . "\n";

// all saved files will be in the  root of the text 
// if this is run on linux, please ensure this folder has proper permissions to be able to be written into
$filename = __DIR__ . "\\files\\" . $email . ".txt";


//if file already exists that means user already exists
if (file_exists($filename)) {
    echo '<form action="index.php">
        <div><h3>User already exists!</h3></div>
        <button type="submit" class="btn btn-default">Return</button>
    </form>';
    die();
}

//try opening the file, if we can't for whatever reason the page will say 'failed!'
$newfile = fopen($filename,"w") or die("failed!");
file_put_contents($newfile, $name);
fwrite($newfile, $content);
fclose($newfile);
header('Location: home.php');
die();
?>