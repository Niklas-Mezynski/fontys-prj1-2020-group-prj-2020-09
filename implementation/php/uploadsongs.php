<?php
session_start();
if(!(isset($_SESSION["user_id"]) && isset($_SESSION["user_role"]))) {
	header("Location: home.php");
	session_destroy();
	exit;
  }
if ($_SESSION["user_role"] < 3) {
    header("Location: main.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload Song</title>
</head>
<body>
    <h1>Hier kann man Songs hochladen :)</h1>
</body>
</html>