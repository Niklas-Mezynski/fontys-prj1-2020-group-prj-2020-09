<?php
    require("dbconnection.php");
    if($_GET["command"] == "restrict"){
        $sqlconnect = "update users u
        set blocked = true
        where user_id = " . $_GET["id"];
        $stmt = $conn -> prepare($sqlconnect);
        $stmt -> execute();
    }else{
        $sqlconnect = "update users u
        set blocked = false
        where user_id = " . $_GET["id"];
        $stmt = $conn -> prepare($sqlconnect);
        $stmt -> execute();
    }
    header("Location: manageUser.php?id=" . $_GET["id"]);
?>