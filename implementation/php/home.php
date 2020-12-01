<!DOCTYPE html>
<html>

<head>
	<title>Home</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../css/main.css"><!-- link to stylesheet -->
	
</head>

<body>

	<main>
		<header>
			<div id="logo"><img id="logo" src="../img/Logo.png" alt="Songify" width="60" height="60" style="display: inline-block; ;"></div>
			<div id="profileButton"><a href="profile.php">User Profile</a></div>
			<div id="title"><p>Songify</p></div>
		</header><!-- end of header -->

		<aside>
			<nav id="menu_v">
				<form action="search.php" method="POST">
					<input type="text" name="search" placeholder="Search.." id="searchbar">
				</form>
				<ul>
					
					<li><a href="library.php">Library</a></li>
					<li><a href="../playlists.php">Playlists</a></li>
					<li><a href="../shop.php">Shop</a></li>
					<li><a href="../trends.php">Trends</a></li>
					<li><a href="logout.php">Logout</a></li>
				</ul>
			</nav><!-- end of nav -->
		</aside>

	<article>
		
		<img id="welcomepic"  src="../img/homepage picture final.png" alt="ein buntes Bild" style="width: 780px">	
		<div>
			<h1 id="welcometexttitle">Welcome to Songify!</h1>
			   <h3 id= "welcometext">It doesn't matter where you are. It doesn't matter who you are. </h3>
			   <h3 id ="welcometext">Music connects us all! Songify is a small platform, which provides it's customers with songs and albums from all around the globe!</h3>
			   <h3 id ="welcometext">Register now, to be able to stream or directly purchase and listen to the greatest hits! And hopefully we can count on seeing your own music on our platform someday! That's right! Our team especially supports independent content creators!</h3>
			   <h3 id = "welcometext">Songify has access to over 1.000.000 Songs and their number is increasing every day!</h3>
			   <h3 id = "welcometext">Become one of our 200.000 already music enjoying and producing users today!</h3>
			   
			 <div class="btn-group">  
			   <a href="register.php"><button class="button" style="vertical-align:middle"><span>Register now! </span></button></a>
			   <a href="login.php"><button class="button" style="vertical-align:middle"><span>Login </span></button></a>
			</div>
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
