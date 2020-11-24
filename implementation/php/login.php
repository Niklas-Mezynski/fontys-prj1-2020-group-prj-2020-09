<!DOCTYPE html>
<html>

<head>
    <title>Home</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/login.css">
</head>

<body>
    <?php
    if (isset($_POST["submit"])) {
        include_once("dbconnection.php");
        $stmt = $conn->prepare("SELECT * FROM users WHERE user_name = :user"); //Username überprüfen
        $stmt->bindParam(":user", $_POST["uname"]);
        $stmt->execute();
        $count = $stmt->rowCount();
        if ($count == 1) {
            if ($count == 1) {
                $row = $stmt->fetch();
                if (password_verify($_POST["pword"], $row["password"])) {
                    if (!($_SESSION["user_id"] = $row["user_id"])) {
                    session_start();
                    $_SESSION["user_id"] = $row["user_id"];
                    }
                } else {
                    echo "Der Login ist fehlgeschlagen";
                }
            } else {
                echo "Der Login ist fehlgeschlagen";
            }
        }
    }
    ?>

    <main>
        <header>
            <div id="logo"><img id="logo" src="../img/Logo.png" alt="Songify" width="60" height="60" style="display: inline-block; ;"></div>
        </header><!-- end of header -->

        <article>
            <div id="login">
                <form action="../home.html" method="POST">
                    <label for="uname">Username or Email</label><br>
                    <input style="color:black;" type="text" id="uname" name="uname" /><br>
                    <label for="pword">Password</label><br>
                    <input style="color:black;" type="password" id="pword" name="pword" /><br>
                    <input style="color:black;" type="submit" value="Submit" name="submit"/>
                </form>
                <p>Not a member?: <a href="register.html">Register here</a></p>
                <p><a href="home.html">Go back to Home</a></p>
            </div>
        </article><!-- end of article -->

        <footer>
            <p>
                <a href="termsandconditions.html">Terms and Conditions</a>
            </p>

        </footer><!-- end of footer -->

    </main><!-- end of main-container -->
</body>

</html>