<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
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
        if ($count == 0) {
            $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email"); //Email überprüfen
            $stmt->bindParam(":email", $_POST["email"]);
            $stmt->execute();
            $count = $stmt->rowCount();
            if ($count == 0) {
                $stmt = $conn->prepare("insert into users (user_id,first_name,last_name,date_of_birth,email,password,user_name,street, house_nr, zip_code, city, country) 
                values (DEFAULT, :fname, :lname, :dob, :email, :pw, :username, :street, :house_nr, :zipcode, :city, :country)");
                $stmt->bindParam(":username", $_POST["uname"]);
                $hash = password_hash($_POST["pword"], PASSWORD_BCRYPT);
                $stmt->bindParam(":pw", $hash);
                $stmt->bindParam(":fname", $_POST["fname"]);
                $stmt->bindParam(":lname", $_POST["lname"]);
                $stmt->bindParam(":dob", $_POST["bdate"]);
                $stmt->bindParam(":email", $_POST["email"]);
                $stmt->bindParam(":street", $_POST["street"]);
                $stmt->bindParam(":house_nr", $_POST["house_nr"]);
                $stmt->bindParam(":zipcode", $_POST["zipcode"]);
                $stmt->bindParam(":city", $_POST["city"]);
                $stmt->bindParam(":country", $_POST["country"]);
                $successful = $stmt->execute();
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
                <?php
                if ($successful) {
                    echo "<h3> Erfolgreich registriert!</h3>";
                }   
                ?>
                <form action="register.php" method="POST">
                    <input style="color:black;" type="email" id="email" name="email" placeholder="Email" /><br>
                    <input style="color:black;" type="text" id="uname" name="uname" placeholder="Username" /><br>
                    <input style="color:black;" type="text" id="fname" name="fname" placeholder="First Name" /><br>
                    <input style="color:black;" type="text" id="lname" name="lname" placeholder="Last Name" /><br>
                    <input style="color:black;" type="date" id="bdate" name="bdate" placeholder="YYYY:MM:DD" /><br>
                    <input style="color:black;" type="text" id="strret" name="street" placeholder="Street" /><br>
                    <input style="color:black;" type="text" id="house_nr" name="house_nr" placeholder="House Nr." /><br>
                    <input style="color:black;" type="text" id="zipcode" name="zipcode" placeholder="Zip Code" /><br>
                    <input style="color:black;" type="text" id="city" name="city" placeholder="City" /><br>
                    <input style="color:black;" type="text" id="country" name="country" placeholder="Country" /><br>
                    <input style="color:black;" type="password" id="pword" name="pword" placeholder="Password" /><br>
                    <input style="color:black;" type="password" id="pwordconfirm" name="pwordconfirm" placeholder="Confirm Password" /><br>
                    <input style="color:black;" type="submit" name="submit" value="Submit" />
                </form>
                <p>Are you a member?: <a href="login.php">Log in here</a></p>
                <p><a href="main.php">Go back to Home</a></p>
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