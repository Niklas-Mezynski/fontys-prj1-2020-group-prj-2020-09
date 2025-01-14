<?php
session_start();
if (isset($_POST["submit"])) {
    include_once("dbconnection.php");
    $stmt = $conn->prepare("SELECT * FROM users WHERE user_name = :user"); //User information
    $stmt->bindParam(":user", $_POST["uname"]);
    $stmt->execute();
    $count = $stmt->rowCount();

    if ($count == 1) {  //If username exists
        $row = $stmt->fetch();
        if (password_verify($_POST["pword"], $row["password"])) {  //Checking password
            $_SESSION["user_id"] = $row["user_id"];
            $_SESSION["user_role"] = $row["user_role"];
            $_SESSION["user_name"] = $row["user_name"];
            header("Location: main.php");
        } else {
            echo "Der Login ist fehlgeschlagen";
        }
    } else {
        echo "Der Login ist fehlgeschlagen";
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="shortcut icon" href="../img/Logo.png" />
</head>

<body>


    <main>
        <header>
            <div id="logo">
                <a href="home.php"><img id="logo" src="../img/Logo.png" alt="Songify" width="60" height="60" style="display: inline-block; ;"></a>
            </div>
        </header><!-- end of header -->

        <article>
            <div class="login">
                <form action="login.php" method="post">
                    <label for="uname">Username</label><br>
                    <input type="text" name="uname" /><br>
                    <label for="pword">Password</label><br>
                    <input type="password" name="pword" /><br>
                    <input type="submit" value="Submit" name="submit" />
                </form>
                <p>Not a member?: <a href="register.php">Register here</a></p>
                <p><a href="main.php">Go back to Home</a></p>
            </div>
        </article><!-- end of article -->

        <footer>
            <p>
                <a href="termsandconditions.php">Terms and Conditions</a>
            </p>

        </footer><!-- end of footer -->

    </main><!-- end of main-container -->
</body>

</html>