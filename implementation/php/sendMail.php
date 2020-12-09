<?php
    include_once("dbconnection.php");
    $sql = "select first_name,last_name,email from users u where user_id = ".$_GET["id"];
    $stmt = $conn -> prepare($sql);
    $stmt -> execute();
    foreach($stmt as $row){
        $msg = "Dear " . $row["first_name"] . " " . $row["last_name"] . ",\n" . 
                "We have to inform you about certain violation of our terms and conditions\n".
                "We send you this message with a warning. We are looking closly on violation of our terms\n" . 
                "Continuing violations will be punnished with a ban from Songify\n\n".
                "Best Regards\nYour Songify-Team";
        $msg = wordwrap($msg,70);
        $address = $row["email"];
        $header = "From: Service@Songify.com";
    }
    if( mail($address,"SONGIFY: VIOLATION OF OUR TERMS",$msg,$header)){
        echo "success";
    }else{
        echo "no success";
    }
    //header("Location: manageUser.php?id=" . $_GET["id"]);
?>