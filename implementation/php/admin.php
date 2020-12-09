<?php
session_start();
if(!(isset($_SESSION["user_id"]) && isset($_SESSION["user_role"]))) {
	header("Location: home.php");
	session_destroy();
	exit;
  }
if ($_SESSION["user_role"] < 4) {
    header("Location: main.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/css/main.css"><!-- link to stylesheet -->
    <link rel="stylesheet" href="/css/adminpannel.css"><!-- link to stylesheet -->
    <title>Admin</title>
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
						echo '<li><a href="playlists.php">Playlists</a></li>';	//If the user_role is Registered or higher, this element will be avaiable
					}
					?>
					<li><a href="shop.php">Shop</a></li>
					<li><a href="trends.php">Trends</a></li>
					<?php
					if ($_SESSION["user_role"] >= 3) {
						echo '<li><a href="uploadsongs.php">Upload Songs</a></li>'; //If the user_role is Artist or Admin, this element will be avaiable
					}
					?>
					<?php
					if ($_SESSION["user_role"] == 4) {
						echo '<li><a href="admin.php">Admin Panel</a></li>'; //if the user_role is Admin, this element will be avaiable
					}
					?>
					<li><a href="logout.php">Logout</a></li>
				</ul>
			</nav><!-- end of nav -->
		</aside>
        <article>
            <div id="contentbox">
                <h1>Admin Interface</h1>
                <form method="POST">
                    <input type="text" id="user_search" placeholder="Search" name="user_search"><br>
					<input type="radio" name="searchRadio" value="User" checked> User Profiles</input>
					<input type="radio" name="searchRadio" value="Artist"> Artist Profiles </input><br>
                </form>
				<ul>
					<?php
						include_once("dbconnection.php");									//This preloads functions and variables in dbconnection.php
						if($_POST["user_search"] != "" || $_POST["user_search"] != null){	//Checks if the searchbar is not empty. If it is not empty...
							$search = strtolower( $_POST["user_search"]);						//...than the searched item will be rewritten in lowercase
							if($_POST["searchRadio"] == "Artist"){								//Checks if the Filter for the search is Artist. If it is ...
								$sql = "select user_id,user_name from users
								where user_role = 3
								and lower(user_name) LIKE '%" . $search . "%'
								order by user_name;";
								$stmt = $conn->prepare($sql);
								$stmt->execute();													//...then the program looks for users who are artists AND have the searched name
								foreach($stmt as $row){
									echo "<li><a href='manageUser.php?id=" . $row["user_id"] . "'>" . $row["user_name"] . "</a></li>";
								}
							}else{																	//...otherwise...
								$sql = "select user_id,user_name from users
								where user_role != 4
								and lower(user_name) LIKE '%" . $search . "%'
								order by user_name;";
								$stmt = $conn->prepare($sql);
								$stmt->execute();													// the program looks for users with the searched name
								foreach($stmt as $row){
									echo "<li><a href='manageUser.php?id=" . $row["user_id"] . "'>" . $row["user_name"] . "</a></li>";
								}
							}
						}else{														//If the Searchbar is empty...
							if($_POST["searchRadio"] == "Artist"){						//...Than it does the process from ll.72-91. Except without the searched user
								$sql = "select user_id,user_name from users
								where user_role = 3
								order by user_name;";
								$stmt = $conn->prepare($sql);
								$stmt->execute();										//This query lists all Artists
								foreach($stmt as $row){
									echo "<li><a href='manageUser.php?id=" . $row["user_id"] . "'>" . $row["user_name"] . "</a></li>";
								}
							}else{
								$sql = "select user_id,user_name from users
								where user_role != 4
								order by user_name;";
								$stmt = $conn->prepare($sql);
								$stmt->execute();										//This query lists evry user except oneself
								foreach($stmt as $row){
									echo "<li><a href='manageUser.php?id=" . $row["user_id"] . "'>" . $row["user_name"] . "</a></li>";
								}
							}
						}
					?>
				</ul>
            </div>
        </article>
        <footer>
            <p>
                <a href="termsandconditions.php">Terms and Conditions</a>
            </p>
        </footer><!-- end of footer -->

    </main><!-- end of main-container -->
</body>
</html>