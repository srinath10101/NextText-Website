<!DOCTYPE html>
<html>
<head>
	<title>NextText Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
</head>
<body style="background-image: url(back.jpg);">

	<img id='menu' src='menu.jpg' />

<?php
		$searchem="";

		session_start();

	if($_SESSION['ema']==""){
		echo '<script type="text/javascript">location.href = "login.php";</script>';
	}
		$servername = "127.0.0.1";
		$dbname="NextText";
		$username = "root123";
		$password = "root";
		$conn = mysqli_connect($servername, $username, $password, $dbname);

		try{
			$res = mysqli_query($conn,"SELECT NAME FROM users WHERE EMAIL=
				'".$_SESSION["ema"]."';");
	
			while($row = mysqli_fetch_array($res)){
				echo '<font size="7" id="welcome"><strong>Welcome, '.$row["NAME"].'</strong></font>';
			}

		}
		catch(Exception $e){
			echo "".$e;
		}

	?>

	<div id='popup'>
		<img src="close.jpg" id='close'><br>
		<font size='7'><a id='homepage' href="home.php">Home</a><br>
		<a id='friends' href="friendslist.php">Friends</a><br>
		<a id='logout' href='home.php?logout=true'>Log Out</a><br>
		</font>
	</div>

	

<?php
	function logthisguyout(){
		$_SESSION["ema"]="";
		echo "<script> location.href='login.php';</script>";
	}
	if(isset($_GET["logout"])){
		logthisguyout();
	}
?>

	
	<form id="mainone" method="GET" autocomplete="off" action="home.php">
		<center>
			<h1>Search for friends by Email</h1>
			<input type="name" autocomplete="off" name="EM" value="" placeholder="Enter the email" id="email"><br><br>
			<button id="btnsearch" name="search" class="btn btn-secondary">Search by Email</button>
			<p id="results"></p>
			<?php
			if(array_key_exists('search',$_GET)){
   				testfun3();
			}	
			?>
		</center>
	</form>
	<?php

		function testfun3(){
			if (isset($_GET['EM'])){
				$searchem = $_GET['EM'];

				$servername = "127.0.0.1";
				$dbname="NextText";
				$username = "root123";
				$password = "root";
				$conn = mysqli_connect($servername, $username, $password, $dbname);
			
				echo '<script language="javascript">';
				echo '$("#results").innerHTML="";';
				echo '</script>';

				echo "<br><br>Results:<br><br><br>";
				if ($searchem!="") {
					$res = mysqli_query($conn,"SELECT * FROM users WHERE EMAIL = '".$searchem."' AND NOT EMAIL='".$_SESSION['ema']."';");
					$man="";

					while($row = mysqli_fetch_array($res)){
						echo $row["NAME"]." "."<a href='chatscreen.php?sendto=".$row["EMAIL"]."'>".$row["EMAIL"]."</a><br>";
						$man = "hi";
					}
					//#results.innerHTML="";
					if($man==""){
						echo '<script language="javascript">';
						echo '$("#results").innerHTML="";';
						echo '</script>';
						echo "No results matching email";
					}
				}
				else{
					echo '<script language="javascript">';
					echo 'alert("Enter an email")';
					echo '</script>';
				}
			}
		}
	?>

	<script type="text/javascript" src="app.js"></script>

</body>
</html>