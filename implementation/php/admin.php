<?php
session_start();
if(!(isset($_SESSION["user_id"]) && isset($_SESSION["user_id"]))) {
	header("Location: home.php");
	session_destroy();
	exit;
  }
require("permmanager.php");
if (get_role() < 4) {
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
    <h1>Geheim!</h1>
</body>
</html>