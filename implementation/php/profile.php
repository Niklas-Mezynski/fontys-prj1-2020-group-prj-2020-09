<?php
session_start();
if (!(isset($_SESSION["user_id"]) && isset($_SESSION["user_role"]))) {
	header("Location: home.php");
	session_destroy();
	exit;
}
if ($_SESSION["user_role"] < 1) {
	header("Location: main.php");
	exit;
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Profile</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/main.css"><!-- link to stylesheet -->
    <link rel="stylesheet" href="../css/profile.css">
</head>

<body>

	<main>
		<header>
			<a href="main.php"><div id="logo"><img id="logo" src="../img/Logo.png" alt="Songify" width="60" height="60" style="display: inline-block; ;"></div></a>
			<div id="profileButton"><a href="profile.php">User Profile</a></div>
			<div id="title">
				<p>Songify</p>
			</div>
		</header><!-- end of header -->

		<aside>
			<nav id="menu_v">
				<form action="search.php" method="POST">
					<input type="text" name="search" placeholder="Search.." id="searchbar">
				</form>
				<ul>
					<li><a href="main.php">Home</a></li>
					<li><a href="library.php">Library</a></li>
					<?php
					if ($_SESSION["user_role"] >= 2) {
						echo '<li><a href="playlists.php">Playlists</a></li>';
					}
					?>
					<li><a href="shop.php">Shop</a></li>
					<li><a href="trends.php">Trends</a></li>
					<?php
					if ($_SESSION["user_role"] >= 3) {
						echo '<li><a href="uploadsongs.php">Upload Songs</a></li>';
					}
					?>
					<?php
					if ($_SESSION["user_role"] == 4) {
						echo '<li><a href="admin.php">Admin Panel</a></li>';
					}
					?>
					<li><a href="logout.php">Logout</a></li>

				</ul>
			</nav><!-- end of nav -->
		</aside>

        <article>
            <div>
                <img id="profilePicture" src="../img/profilepicture-placeholder.jpg" height="128">
            </div>
            <ul>
            <?php
                require("dbconnection.php");
                $sqlconnect = "select First_Name, Last_Name, date_of_birth, email, password, subscription_status
                                from users u 
                                where user_id = :user_id";
                
                $stmt = $conn -> prepare($sqlconnect);
                $stmt -> bindParam(":user_id", $_SESSION['user_id']);
                $stmt -> execute();
                foreach($stmt as $row) {
                    //$subscription_status = $row["subscription_status"];
                    echo "<li>First Name: " . $row ['first_name'] . 
                        "<li> Last Name: " . $row ['last_name'] . 
                        "<li> Geburtstag: " . $row ['date_of_birth'] .
                        "<li> Email: " . $row ['email'];
                    if($subscription_status = true) {
                        echo ' <li>Subscription status: Subscription active';
                    } else {
                        echo ' <li>Subscription status: Subscription aktiv is not active';
                    }
                }
                
            ?>
            
            </ul>
            <br>


            <?php
                
                if (isset($_POST["submit"])) {
                    include_once("dbconnection.php");
                    $stmt2 = $conn->prepare("SELECT * FROM users WHERE user_name = :user"); //Username überprüfen
                    $stmt2->bindParam(":user", $_SESSION["user_name"]);
                    $stmt2 -> execute();
                    $row = $stmt2 -> fetch();
                    if (password_verify($_POST["opword"], $row["password"])) {
                        $sql = "update users
                            set password =:pword
                            where user_id = :user_id";
                        $stmt = $conn->prepare($sql);
                        $hash = password_hash($_POST['pword'], PASSWORD_BCRYPT);
                        $stmt-> bindParam(":pword", $hash);
                        $stmt -> bindParam(":user_id", $_SESSION['user_id']);
                        $var1 = $_POST['pword'];
                        $var2 = $_POST['rpword'];
                        if($var1 == $var2){
                            $stmt -> execute();
                            echo'Password change was sucessfull!';
                        } else {
                            echo'Password change was not sucessfull!';
                        }
                        
                    } else {
                        echo'Password is incorrect!';
                    }
                    
                    
                }
            ?>

            <br>
            <form method="post" action="profile.php">
                    <input type="password" id="pword" name="opword" placeholder="Old password" /><br>
                    <input type="password" id="pword" name="pword" placeholder="New password" /><br>    
                    <input type="password" id="rpword" name="rpword" placeholder="Repeat Password" /><br>
                    <input type="submit" name="submit" value="Submit" />
            </form> 
            
            <br>
            <br>
            

        </article>

        <footer>
            <p>
                <a href="termsandconditions.php">Terms and Conditions</a>
            </p>

        </footer><!-- end of footer -->

    </main><!-- end of main-container -->

</body>

</html>