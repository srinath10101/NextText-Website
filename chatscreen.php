<!DOCTYPE html>
<html>
<head>
	<title>NextText Chat</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="style2.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
</head>
<body style="background-image: url(back.jpg);">
	<img src="backbutt.jpg" id="backb"/>
	<p id="mess"></p>
	<?php
		session_start();
		if($_SESSION["ema"]==""){
			echo '<script type="text/javascript">location.href = "login.php";</script>';
		}

		define("const1",3);
		define("const2",7);
		define("const3",8);
		define("const4",2);
		define("const5",6);
		define("const6",10);

		function encrypt($hello){
			$strlen = strlen($hello);
			$encstr = "";
			for($i=0;$i<$strlen;$i++){
				$char = substr($hello,$i,1);
				$n = rand(1,5);
				$ascii = ord($char);
				$resu = 0;
				switch($n){
					case 1:  $resu = ($ascii*const1) - const2;
						break;
					case 2: $resu = const3 + ($ascii*const1);
						break;
					case 3:  $resu = const4 + ($ascii*const3); 
						break;
					case 4: $resu = ($ascii*const5) - const6;
						break;
					case 5: $resu = const2 + ($ascii*const3);
						break;
					default: echo "what is happening";
				}
				$encstr= $encstr.$resu.",".$n.",";
			}
			return $encstr;
		}

		function decrypt($helloworld){
			$strlen = strlen($helloworld);
			$decstr = "";
			for($i=0;$i<$strlen;$i++){
				$char = substr($helloworld,$i,1);
				$strint="";
				while($char!=','){
					$strint=$strint.$char."";
					$i++;
					$char = substr($helloworld,$i,1);
				}
				$todecode = (int) $strint;
				$i++;
				$char = substr($helloworld,$i,1);
				$asc=0;
				switch((int) $char){
					case 1: $asc = (int) (($todecode + const2)/const1) ;
						break;
					case 2: $asc = (int) (($todecode - const3)/const1);
						break;
					case 3: $asc = (int) (($todecode - const4)/const3);
						break;
					case 4: $asc = (int) (($todecode + const6)/const5);
						break;
					case 5: $asc = (int) (($todecode - const2)/const3);
						break;
					default: echo "whaaaaaat";
				}
				$decstr = $decstr.chr($asc);
				$i++;

			}
			return $decstr;
		}

		function loadmessages(){
			$receiver = $_SESSION["sendemto"];
			$sender = $_SESSION["ema"];
			$servername = "127.0.0.1";
			$dbname="NextText";
			$username = "root123";
			$password = "root";
			$conn = mysqli_connect($servername, $username, $password, $dbname);
			echo "<script>document.getElementById('mess').innerHTML='';</script>";
			$query = "SELECT * FROM CHATS WHERE P1 IN('".$sender."','".$receiver."') AND P2 IN('".$sender."','".$receiver."');";
			$res = mysqli_query($conn,$query);
			$towrite="";
			while($row = mysqli_fetch_array($res)){
				$messa = $row["MESSAGES"];
				$strlen2 = strlen($messa);
				$whoissender="";
				$i=0;
				$c = substr($messa,$i,1);
				while($c != '|'){
					$whoissender = $whoissender.$c;
					$i++;
					$c = substr($messa,$i,1);
				}
				$i++;
				$c = substr($messa,$i,1);
				$todecryptthis="";
				while($c != '|'){
					$todecryptthis = $todecryptthis.$c;
					$i++;
					$c = substr($messa,$i,1);
				}
				$decmess = decrypt($todecryptthis);
				
				$towrite = $towrite."<strong>".$whoissender."</strong> : ".$decmess."<br>";
				

			}
			//echo $towrite;
			if(!empty($towrite)){
				echo "<script>$('#mess').append('".$towrite."');</script>";
			}

		}

		?>
		<?php
		if(isset($_GET["sendto"])){
			$_SESSION["sendemto"] = $_GET["sendto"];
		}
		$sendem = $_SESSION["sendemto"];
		$servername = "127.0.0.1";
		$dbname="NextText";
		$username = "root123";
		$password = "root";
		$conn = mysqli_connect($servername, $username, $password, $dbname);
		$senderem = $_SESSION["ema"];

		try{
			$query = "SELECT * FROM CHATS WHERE P1 IN('".$senderem."','".$sendem."') AND P2 IN('".$sendem."','".$senderem."');";
			$res = mysqli_query($conn,$query);
			if($row = mysqli_fetch_array($res)){
				loadmessages();
			}
			else{
				echo "<script>document.getElementById('mess').innerHTML = '<strong>Start Typing and Hit Enter to start a conversation!</strong>';</script>";
				
			}
		}
		catch(Exception $e){
			echo $e."";
		}

	?>

	<form method="GET" autocomplete="off">
		<!--<textarea name="sendthis11" id="me"></textarea>-->
		<input type="text" name="sendthis11" id="me" placeholder="Type here. Press Enter to send">
		<input type="submit" name="submitbutt" id="sendbutt" value="SEND">
	</form>
<!--	
<a href="#" name><img src="sendmes.jpg" id="sendbutt"/></a>	
-->
	<?php

/*
		if(isset($_GET["sendclick"])){
			testfunxx();
		}*/

		if(array_key_exists('submitbutt',$_GET)){
   				testfunxx();
		}

		function testfunxx(){
			$message="";
			if(isset($_GET["sendthis11"]))
				$message = $_GET["sendthis11"];
			
			if($message == ""){
				echo "<script>alert('Type something and hit SEND!');</script>";
			}
			else{
				$servername = "127.0.0.1";
				$dbname="NextText";
				$username = "root123";
				$password = "root";
				$conn = mysqli_connect($servername, $username, $password, $dbname);
		
				$whatup = encrypt($message);
				$receiver = $_SESSION["sendemto"];
				$sender = $_SESSION["ema"];
				try{
					$query = "SELECT * FROM CHATS WHERE (P1='".$sender."' AND P2='".$receiver."') OR ( P1='".$receiver."' AND P2='".$receiver."');";
					$res = mysqli_query($conn,$query);

					loadmessages();
					$query = "INSERT INTO CHATS VALUES"
						."('".$sender."','".$receiver."','".$sender."|".$whatup."|');";
					$res = mysqli_query($conn,$query);
					loadmessages();
				}
				catch(Exception $e){
					echo $e."";
				}
				//echo $whatup."<br>";
				//echo decrypt("".$whatup);
			}
			unset($_GET["sendthis11"]);
			unset($_GET["sendclick"]);
			
		}
			
	?>
	<script src="app2.js"></script>

</body>
</html>