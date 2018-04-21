<!DOCTYPE html>
<html>
<head>
	<title>NextText Sign Up</title>
	<meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width,height=device-height, initial-scale=1" />
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

</head>
<body style="background-image: url(back.jpg);">

	<br><br><br><br><br><br>
	<form method="GET">
		<center>
		<font size="20"><h1>Sign Up</h1></font>
			Name: <input type="name" name="Nam" placeholder="Name" id="email"><br><br>
			Email: <input type="email" name="EM" placeholder="Email" id="email"><br><br>
			Password: <input type="password" name="PASS" placeholder="Password" id="pass"><br>
			Re-type Password:<input type="password" name="PASS2" placeholder="Re type Password" id="pass"><br><br>
			<button id="btnsignup" name="signup" class="btn btn-secondary">Sign Up</button>
	</center>

	</form>

	<?php
	session_start();
		if(array_key_exists('signup',$_GET)){
   			testfun();
		}
		function testfun(){
			$Name="";
			$EM1="";
			$pass1="";
			$pass2="";
			$servername = "127.0.0.1";
			$username = "root123";
			$dbname="NextText";
			$password = "root";
			$dbname="NextText";
			$conn = mysqli_connect($servername, $username, $password,$dbname);
			if(isset($_GET['Nam']) && isset($_GET['EM']) && isset($_GET['PASS']) && 
				isset($_GET['PASS2'])){
				$Name = $_GET['Nam'];
				$EM1 = $_GET['EM'];
				$pass1 = $_GET['PASS'];
				$pass2 = $_GET['PASS2'];
				if($Name !="" && $EM1 != "" && $pass1 != "" && $pass2 !=""){
					if($pass1 == $pass2){
						if (!preg_match("/^[a-zA-Z ]*$/",$Name)){
                			echo '<script language="javascript">';
							echo 'alert("Enter Valid name.")';
							echo '</script>';
            			}   
            			else{
            				$res = mysqli_query($conn,"INSERT 
            					INTO USERS VALUES('".$Name."','".$EM1."','".md5($pass1)."')");
            				if($res==1){
            					/*
            						RE-DIRECT TO CHAT HOME
            					*/
            					echo '<script language="javascript">';
								echo 'alert("ACCOUNT CREATED")';
								echo '</script>';
								$_SESSION['ema'] = $EM1;
						echo '<script type="text/javascript">location.href = "home.php";</script>';
            				}
						}
					}
					else{
						echo '<script language="javascript">';
						echo 'alert("Passwords do not match.")';
						echo '</script>';
					}
				}
				else{
					echo '<script language="javascript">';
					echo 'alert("Enter all the details to sign up!")';
					echo '</script>';
				}
			}
			else{
				echo '<script language="javascript">';
				echo 'alert("Enter all the details!")';
				echo '</script>';
			}
		}

	?>

</body>

</html>