<!DOCTYPE html>
<html>
<head>
	<title>NextText Login</title>
</head>
<body style="background-image: url(back.jpg);">
<?php
	if(session_status() == PHP_SESSION_NONE) 
		session_start();
	try{
		if(!empty($_SESSION["ema"])) {
			echo '<script type="text/javascript">location.href = "home.php";</script>';
		}
		else{
			
		}
	}
	catch(Exception $e){
		echo $e;
	}
?>
	<br><br><br><br><br><br>
	<form method="GET" autocomplete="off">
		<center>
		<font size="5"><h1>Log In</h1></font>
			<input type="email" autocomplete="off" name="EM" value="" placeholder="Email" id="email"><br><br>
			<input type="password" autocomplete="off" name="PASS" value="" placeholder="Password" id="pass"><br><br>
			<button id="btnlogin" name="login" class="btn btn-secondary">Log In</button>
			<button id="btnsignup" name="signup" class="btn btn-secondary">Sign Up</button>
	</center>
	</form>


	<?php
		if(session_status() == PHP_SESSION_NONE)
		session_start();
		

	if(array_key_exists('signup',$_GET)){
   		testfun2();
	}
	if(array_key_exists('login',$_GET)){
   		testfun();
	}

	
		function testfun2()
		{
			echo '<script type="text/javascript">location.href = "signup.php";</script>';
		}

		function testfun(){
		
			$servername = "127.0.0.1";
			$dbname="NextText";
			$username = "root123";
			$password = "root";
			$conn = mysqli_connect($servername, $username, $password, $dbname);
			
			$em = "";
			$pass = "";
			if (isset($_GET['EM']) && isset($_GET['PASS'])){
	 	   		$em = $_GET['EM'];
				$pass = md5($_GET['PASS']);
				$check = 0;
				if($em!=""  && $pass != ""){
					try{
						$res = mysqli_query($conn,"SELECT * FROM users;");
					
						while($row = mysqli_fetch_array($res))
							if($em == $row["EMAIL"] && $pass == $row["pass"])
								$check = 1;
						

						if($check==1){
							$_SESSION["ema"] = $em;
							echo '<script type="text/javascript">location.href = "home.php";</script>';
							// RE-DIRECT TO CHAT HOME
						}
						else{	
							echo '<script language="javascript">';
							echo 'alert("Please sign up. User does not exist!")';
							echo '</script>';
						}
					}
					catch(Exception $e){
						echo ""+$e;
					}
				}
				else{
					echo '<script language="javascript">';
					echo 'alert("Enter all the details.")';
					echo '</script>';
				}
			
			}
			else{
					echo '<script language="javascript">';
					echo 'alert("Enter all the details.")';
					echo '</script>';
				}
	

		} 


	?>



</body>
</html>