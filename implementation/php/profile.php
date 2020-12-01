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
    <title>Home</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/main.css"><!-- link to stylesheet -->
    <link rel="stylesheet" href="../css/profile.css">
</head>

<body>

	<main>
		<header>
			<div id="logo"><img id="logo" src="../img/Logo.png" alt="Songify" width="60" height="60" style="display: inline-block; ;"></div>
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
                    $subscription_status = $row["subscription_status"];
                    echo "<li>First Name: " . $row ['first_name'] . 
                        "<li> Last Name: " . $row ['last_name'] . 
                        "<li> Geburtstag: " . $row ['date_of_birth'] .
                        "<li> Email: " . $row ['email'] .  
                    if($subscription_status = true) {
                        echo ' <li>Subscription status: Abo ist aktiv';
                    } else {
                        echo ' <li>Subscription status: Abo ist nicht aktiv';
                    }
                }
            ?>
            <li> <a href="changepassword.php">Changepassword</a></li>
            </ul>
            
            
            <!--<div id="profilebox">
                <p class="profiletext"><label for="fname">First name: </label></p>
                <p class="profiletext"><label for="lname">Last name: </label></p>
                <p class="profiletext"><label for="bday">Birthdate: </label></p>
                <p class="profiletext"><label for="email">Email: </label></p>
                <p class="profiletext"><label for="password">Password: </label></p>
            </div>



            "<li> Subscription status: " .$row['subscription_status'] .

            <div>
                <form method="post" action="dbconnection.php">

                    <p class="profiletext"><input type="text" id="fname" name="fname"></p>
                    <p class="profiletext"><input type="text" id="lname" name="lname"></p>
                    <p class="profiletext"><input type="number" id="bday" name="bday"></p>
                    <p class="profiletext"><input type="email" id="email" name="email"></p>
                    <p class="profiletext"><input type="password" id="password" name="password"></p>

                    <form action="changepassord.html">
                        <input class="button" type="submit" value="change password" />
                    </form>
                </form>
            </div>
            -->
            <br>
            <br>
            <div id="sub">
                <p>Subscription End Date: DD-MM-YYYY</p>
            </div>

        </article>

        <footer>
            <p>
                <a href="termsandconditions.html">Terms and Conditions</a>
            </p>

        </footer><!-- end of footer -->

    </main><!-- end of main-container -->

</body>

</html>