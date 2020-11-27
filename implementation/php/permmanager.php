<?php
session_start();
function get_role() {
    require("dbconnection.php");
    $stmt = $conn->prepare("select user_role from users where user_id = :user_id");
    $stmt->bindParam(":user_id", $_SESSION["user_id"]);
    $stmt->execute();
    $row = $stmt->fetch();
    return $row["user_role"];
}
