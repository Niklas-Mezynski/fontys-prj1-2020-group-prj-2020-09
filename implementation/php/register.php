<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="shortcut icon" href="../img/Logo.png" />
</head>

<body>
    <?php
    if(isset($_POST["submit"])) {
        if(isset($_POST["checkbox"])) {
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
                    if ($_POST["pword"] == $_POST["pwordconfirm"]) {
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
                    } else {echo "Die Passwörter stimmen nicht überein";}
                } else {echo "Email wird bereits verwendet.";}
            } else {echo "Username ist bereits vergeben";}
        } else {
            $TermsAndConditions = true;
        }
    } 
    ?>
    <main>
        <header>
            
               <a href = "home.php"><div id="logo"><img id="logo" src="../img/Logo.png" alt="Songify" width="60" height="60" style="display: inline-block; ;"></div></a>
            
        </header><!-- end of header -->

        <article>

            <div id="login">
                <?php
                if ($successful) {
                    echo "<h3> Erfolgreich registriert!</h3>";
                }
                if ($TermsAndConditions) {
                    echo "<h3> You have to accept the terms and conditions</h3>";
                }
                ?>
                <form action="register.php" method="POST">
                    <input type="email" id="email" name="email" placeholder="Email" required/><br>
                    <input type="text" id="uname" name="uname" placeholder="Username" required/><br>
                    <input type="text" id="fname" name="fname" placeholder="First Name" required/><br>
                    <input type="text" id="lname" name="lname" placeholder="Last Name" required/><br>
                    <input type="date" id="bdate" name="bdate" placeholder="YYYY:MM:DD" required/><br>
                    <input type="text" id="strret" name="street" placeholder="Street" required/><br>
                    <input type="text" id="house_nr" name="house_nr" placeholder="House Nr." required/><br>
                    <input type="text" id="zipcode" name="zipcode" placeholder="Zip Code" required/><br>
                    <input type="text" id="city" name="city" placeholder="City" required/><br>
                    <input type="text" id="country" name="country" placeholder="Country" required/><br>
                    <input type="password"  minlength="8" id="pword" name="pword" placeholder="Password" required/><br>
                    <input type="password"  minlength="8" id="pwordconfirm" name="pwordconfirm" placeholder="Confirm Password" required/><br>
                    <label for="checkbox"> I have read and accept the <a href="termsandconditions.php">terms and conditions</a></label><br>
                    <input type="checkbox" id="checkbox" name="checkbox" required/><br>
                    <input type="submit" name="submit" value="Submit" />
                </form>
                <p>Are you a member?: <a href="login.php">Log in here</a></p>
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