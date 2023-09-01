<?php
	session_start();
	if(isset($_SESSION['data']))
	{	
		$data=date('Y-m-d H:i:s');
		if($_SESSION['data']<$data)
		{
			session_destroy();
			header("Location:../account/login.php");
		}
		else
			$_SESSION['data']= date('Y-m-d H:i:s',strtotime('+1 hour',strtotime(date('Y-m-d H:i:s'))));
	}
	
	if(isset($_SESSION['utente']))
	{
		include "dbconfig/dbopen.php";
		$query='select nome,cognome
				from account
				where email="'.$_SESSION['utente'].'"';
		$tabella=mysqli_query($dbconn,$query) or die (mysqli_error($dbconn));
		if(mysqli_num_rows($tabella)==0)
			header("Location:../account/utente.php");
		if($riga=mysqli_fetch_array($tabella))
		{
			$nome=$riga['nome'];
			$cognome=$riga['cognome'];
		}
		include "dbconfig/dbclose.php";
	}
	else
		header("Location:../account/login.php");
?>

<! DOCTYPE html>
<html>
	<head>
		<title>Impostazioni</title>
		<meta charset="UTF-8"/>
		<link rel="stylesheet" type="text/css" href="../../css/style.css"/>
		<link rel="stylesheet" type="text/css" href="../../css/720style.css"/>
		<link rel="stylesheet" type="text/css" href="../../css/1080style.css"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
		<link rel="icon" href="../../img/icone/ico.png"/>
	</head>
	<body>
		<div class="contenitore">
			<div class="nav">
				<img src='../../img/icone/logo.png' alt='Logo' width='150px' style="float:left;"/>
				<div class="dropdown-special" style='width:auto'>
					<p style="float:left;margin-left:20px"><strong><?php echo $nome;?> <?php echo $cognome;?></strong> &nbsp;<i class="fas fa-sort-down"></i>  &nbsp;</p>
					<img src='../../img/icone/ico.png' height='60px'/>
					<div class="dropdown-content" style='margin-top:0px'>
						<a href="../home/home.php">Torna alla Home <i class="fas fa-clipboard-list"></i></a>
						<br><br>
						<a href='utente.php'>Sel. utente <i class="fas fa-user-circle"></i></a>
						<br><br>
						<a href="logout.php">Logout <i class="fas fa-sign-out-alt"></i></a>
					</div>
				</div>
			</div>
			<h1 class='intestazione-h1'>Impostazioni</h1>
			<div class="testo" style='margin-top:50px'>
				<div class='login' style="width:400px;text-align:center">
					<h1 id='h1conf'>ATTENZIONE!</h1>
					<p style='color:white;'>Se cancelli l'account, <strong>perderai l'account per sempre da questo sito</strong> e potrai sempre ri-registrare</p>
					<form action="cancella.php" method="POST" class="formcancella" style="margin:0;background:none;height:200px">
						<input type="password" name="psw" placeholder="Inserire psw per confermare"/><br>
						<input type="submit" id="submit" value="Clicca per cancellare" style="background-color:red;color:white;"/>
					</form>
					<a id='submit' href='impostazioni.php' style='text-decoration:none;color:white'>Premi per tornare indietro</a>					
					
				</div>
				<?php
					if(isset($_POST['psw']))
					{
						include "dbconfig/dbopen.php";
						$query="select psw
								from account
								where email='".$_SESSION['utente']."'";
						$tabella=mysqli_query($dbconn,$query) or die (mysqli_error($dbconn));
						if($riga=mysqli_fetch_array($tabella))
							if(md5($_POST['psw'])==$riga['psw'])
							{
								$query="DELETE guarda.*
										FROM utente INNER JOIN guarda 
										on utente.id=guarda.id WHERE email='".$_SESSION['utente']."'";
								mysqli_query($dbconn,$query) or die(mysqli_error($dbconn));
								$query="delete utente.* from utente where email='".$_SESSION['utente']."'";		
								mysqli_query($dbconn,$query) or die(mysqli_error($dbconn));
								$query="delete account.* from account where email='".$_SESSION['utente']."'";		
								mysqli_query($dbconn,$query) or die(mysqli_error($dbconn));
								session_destroy();
								include "dbconfig/dbclose.php";
								header("Location:login.php");
							}
							else
								echo "	<div class='errore' style='width:375px'>
											<p><strong>ERRORE</strong> Impossibile cancellare l'account, password sbagliata</p>
										</div>";
					}
				?>
				<script>
					bianco();
					function bianco()
					{
						document.getElementById('h1conf').style.background='rgba(58,39,95,0.95)';
						interval=setTimeout(rosso, 1000);
					}
					function rosso()
					{
						document.getElementById('h1conf').style.background='red';
						interval=setTimeout(bianco, 1000);
					}
				</script>
			</div>
		</div>
	</body>
</html>