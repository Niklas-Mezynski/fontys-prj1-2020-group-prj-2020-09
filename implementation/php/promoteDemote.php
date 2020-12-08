<?php
    require("dbconnection.php");
    if($_GET["command"] == "promote"){
        $sqlconnect = "update users u
        set user_role = 3
        where user_id = " . $_GET["id"];
        $stmt = $conn -> prepare($sqlconnect);
        $stmt -> execute();
    }else{
        $sqlconnect = "update users u
        set user_role = 2
        where user_id = " . $_GET["id"];
        $stmt = $conn -> prepare($sqlconnect);
        $stmt -> execute();
    }
    header("Location: manageUser.php?id=" . $_GET["id"]);
?>