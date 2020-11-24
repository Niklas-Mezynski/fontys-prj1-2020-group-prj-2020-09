<?php
    $host = "prj1_postgres";
    $port = "5432";
    $db = "postgres";   /*Just for now*/
    $user = "postgres";
    $pword = "mypassword";

    $dsn = "pgsql:host=$host;port=$port;dbname=$db;user=$user;password=$pword";

    try{
        $conn = new PDO($dsn);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if($conn){
            //echo "Connection to the $db database successfully";
        }
    }catch(PDOException $e){
        echo $e->getMessage();
    }
?>