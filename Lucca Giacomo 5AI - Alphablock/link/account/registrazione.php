<?php 
	session_start();
	if(isset($_SESSION['utente']))
		header("Location:utente.php");
	function errore()
	{
		echo "<div class='errore'>
				<p><strong>ERRORE</strong> Le password non combaciano o email già utilizzata.</p>
			</div>";
	}
	
?>
<! DOCTYPE html>
<html>
	<head>
		<title>Registrazione</title>
		<meta charset="UTF-8"/>
		<link rel="stylesheet" type="text/css" href="../../css/style.css"/>
		<link rel="stylesheet" type="text/css" href="../../css/720style.css"/>
		<link rel="stylesheet" type="text/css" href="../../css/1080style.css"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="icon" href="../../img/icone/ico.png"/>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
	</head>
	<body style="background-image:url(../../img/icone/wp1945897.jpg);background-attachment:fixed;background-size:cover">
		<img src="../../img/icone/logo.png" width="150px" style="float:left;margin-top:-75px;margin-left:10px">
		<div class="login">
			<h1>Registrazione</h1>
			<br>
			<img src="../../img/icone/ico.png" height="200px" style="float:left;border-radius:20px;background-color:white"/>
			<form action="registrazione.php" method="POST">
				<h3>Completa i campi sottostanti</h3>
				<input type="text" name="email" placeholder="Email *"/>
				<br>
				<input type="password" name="psw" placeholder="Password *"/>
				<input type="password" name="conferma" placeholder="Conferma password *"/>
				<br>
				<hr>
				<input type="text" name="nome" placeholder="Nome *"/>
				<input type="text" name="cognome" placeholder="Cognome *"/>
				<br><br>
				<input id='submit' type="submit" value="Registrati" />
			</form>
			<?php
				if(isset($_POST['email'])&&isset($_POST['psw'])&&isset($_POST['nome'])&&isset($_POST['cognome'])&&isset($_POST['conferma'])
					&&$_POST['email']!=""&&$_POST['psw']!=""&&$_POST['nome']!=""&&$_POST['cognome']!=""&&$_POST['conferma']!="")
				{
					if($_POST['psw']==$_POST['conferma'])
					{
						include "dbconfig/dbopen.php";
						$query="INSERT INTO `account`(`email`, `psw`, `nome`, `cognome`,`dataisc`) VALUES
								('".mysqli_real_escape_string($dbconn,$_POST['email'])."',
								'".mysqli_real_escape_string($dbconn,md5($_POST['psw']))."',
								'".mysqli_real_escape_string($dbconn,$_POST['nome'])."',
								'".mysqli_real_escape_string($dbconn,$_POST['cognome'])."',now())";
						mysqli_query($dbconn,$query) or die(errore());
						
						$query="INSERT INTO `utente`( `email`, `nome`, `bimbo`, `img`) VALUES
								('".mysqli_real_escape_string($dbconn,$_POST['email'])."','".mysqli_real_escape_string($dbconn,$_POST['nome'])."',0,1)";		
						mysqli_query($dbconn,$query) or die(errore());
						include "dbconfig/dbclose.php";
						header("Location:successo.html");
					}
					else
						errore();
				}
			?>
		</div>
	</body>
</html>