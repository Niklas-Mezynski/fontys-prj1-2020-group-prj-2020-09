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
    <link rel="stylesheet" href="../css/manageUser.css">
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
        <div id="commandBox">
                <a href="">Restrict User</a><br>
                <?php
                require("dbconnection.php");
                $sqlconnect = "select u.User_Name, ur.role_id ,ur.role_name
                from users u 
                inner join user_role ur on u.user_role = ur.role_id
                where user_id = " . $_GET["id"];

                $stmt = $conn -> prepare($sqlconnect);
                $stmt -> execute();
                foreach($stmt as $row) {
                    if($row["role_id"] == 3){
                        echo "<a href='promoteDemote.php?command=demote&id=".$_GET["id"]."'>Demote User to an Registered User</a><br>";
                    }else{
                        echo "<a href='promoteDemote.php?command=promote&id=".$_GET["id"]."'>Promote User to an Artist</a><br>";
                    }
                }   
                ?>
                <a href="">Send Warning-Message per mail</a><br>
            </div>
            <div>
                <img id="profilePicture" src="../img/profilepicture-placeholder.jpg" height="128">
            </div>
            <ul>
            <?php
                $sqlconnect = "select u.User_Name, ur.role_id ,ur.role_name
                                from users u 
                                inner join user_role ur on u.user_role = ur.role_id
                                where user_id = " . $_GET["id"];
                
                $stmt = $conn -> prepare($sqlconnect);
                $stmt -> execute();
                foreach($stmt as $row) {
                    //$subscription_status = $row["subscription_status"];
                    echo "<li>User: " . $row['user_name'] . "</li>" .
                        "<li> User Role: " . $row['role_name'] . "</li><br>" .
                        "<li> Informations: </li>" . 
                        "<li> Violations of Terms: " . "X" . "</li>" . 
                        "<li> Purchases: " . "X" . "</li>" . 
                        "<li> Sales: " . "X" . "</li>" . 
                        "<li> Created Albums: " . "X" . "</li>";
                }                
            ?>
            </ul>
        </article>

        <footer>
            <p>
                <a href="termsandconditions.html">Terms and Conditions</a>
            </p>

        </footer><!-- end of footer -->

    </main><!-- end of main-container -->

</body>

</html>