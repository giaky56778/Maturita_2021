<?php 
	session_start();
	if(isset($_SESSION['data']))
	{	
		$data=date('Y-m-d H:i:s');
		if($_SESSION['data']<$data)
		{
			session_destroy();
			header("Location:login.php");
		}
		else
			$_SESSION['data']= date('Y-m-d H:i:s',strtotime('+1 hour',strtotime(date('Y-m-d H:i:s'))));
	}
	
	if(isset($_SESSION['utente']))
		header("Location:utente.php");
?>
<! DOCTYPE html>
<html>
	<head>
		<title>Login</title>
		<meta charset="UTF-8"/>
		<link rel="stylesheet" type="text/css" href="../../css/style.css"/>
		<link rel="stylesheet" type="text/css" href="../../css/720style.css"/>
		<link rel="stylesheet" type="text/css" href="../../css/1080style.css"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="icon" href="../../img/icone/ico.png"/>
	</head>
	<body style="background-image:url(../../img/icone/wp1945897.jpg);background-attachment:fixed;background-size:cover;background-repeat: no-repeat;">
		<div class="contenitore">
			<img src="../../img/icone/logo.png" width="150px" style="float:left;margin-top:-75px;margin-left:10px">
			<div class="login" style="width:400px">
				<h1>Login</h1>
				<form action="login.php" method="POST" style="text-align:center;margin:0">
					<input type="text" name="email" placeholder="Email"/>
					<br>
					<input type="password" name="psw" placeholder="Password"/>
					<br><br>
					<input type="checkbox" name="ricordo" style='margin-left:-50px'/>
					<label for="ricordo"> Resta connesso</label>
					<br>
					<input id="submit" type="submit" value="Login" style="width:200px"/>
					<br>
					<hr>
					<p style="float:left">Prima volta?  <a href="registrazione.php">Registrati qui</a></p>
				</form>

				<?php
					if(isset($_POST['email'])&&isset($_POST['psw']))
					{
						include "dbconfig/dbopen.php";
						$query="select email
								from account
								where email='".mysqli_real_escape_string($dbconn,$_POST['email'])."'
								and psw='".mysqli_real_escape_string($dbconn,md5($_POST['psw']))."'";
						$tabella=mysqli_query($dbconn,$query) or die(mysqli_error($dbconn));
						if(mysqli_num_rows($tabella)==1)
						{
							$_SESSION['utente']=$_POST['email'];
							if(!isset($_POST['ricordo']))
								$_SESSION['data']= date('Y-m-d H:i:s',strtotime('+1 hours',strtotime(date('Y-m-d H:i:s'))));
							header("Location:utente.php");
						}
						else
							echo "	<div class='errore' style='width:375px'>
										<p><strong>ERRORE</strong> Non esiste l'account associato a quest'email oppure password sbagliata.</p>
									</div>";
						include "dbconfig/dbclose.php";
					}
				?>
			</div>
		</div>
	</body>
</html>