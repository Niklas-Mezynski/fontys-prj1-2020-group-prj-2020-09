<?php
session_start();
if(!(isset($_SESSION["user_id"]) && isset($_SESSION["user_role"]))) {
	header("Location: home.php");
	session_destroy();
	exit;
  }
if ($_SESSION["user_role"] < 4) {
    header("Location: main.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
</head>
<body>
    <h1>Hier können nur Admins hin.</h1>
</body>
</html>