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
	{
		include "dbconfig/dbopen.php";
		$query='select nome,cognome
				from account
				where email="'.$_SESSION['utente'].'"';
		$tabella=mysqli_query($dbconn,$query) or die (mysqli_error($dbconn));
		if($riga=mysqli_fetch_array($tabella))
		{
			$nome=$riga['nome'];
			$cognome=$riga['cognome'];
		}
		include "dbconfig/dbclose.php";
	}
	else
		header("Location:../account/login.php");
	
	
	
	function errore()
	{
		echo "	<div class='errore' style='width:400px;'>
					<p><strong>ERRORE</strong> Le password non corrispondono.</p>
				</div>";
	}
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
			<h1 style='text-align:center;margin-top:-65px;font-size:28pt;color:rgba(255,255,255,0.9)'>Impostazioni</h1>
			<div class="testo" style='margin-top:50px'>
				<div class='login' style="width:400px;text-align:center">
					<?php
						if(isset($_POST['conferma'])&&isset($_POST['vecchia_password'])&&isset($_POST['nuova_password']))
						{
							
							include "dbconfig/dbopen.php";
							$query='select psw
									from account
									where email="'.$_SESSION['utente'].'"';
							$tabella=mysqli_query($dbconn,$query) or die (errore());
							if($riga=mysqli_fetch_array($tabella))
								if(md5($_POST['vecchia_password'])==$riga['psw']&&$_POST['nuova_password']==$_POST['conferma'])
								{
									$query="UPDATE `account` SET `psw`='".mysqli_real_escape_string($dbconn,md5($_POST['conferma']))."' WHERE email='".$_SESSION['utente']."'";
									mysqli_query($dbconn,$query) or die (errore());
									echo "<p style='color:white'>Cambio eseguito con successo</p>";
			
								}
								else
									errore();
							include "dbconfig/dbclose.php";
						}
						else
						{
					?>
					<h1>Cambia password</h1>
					<form method='POST' action='password.php' style="width:350px;margin-left:10px">
						<label for='vecchia_password'>Inserire vecchia psw: </label>
						<input type='password' name='vecchia_password' placeholder='Vecchia password'/>
						<hr>
						<label for='nuova_password'>Inserire nuova psw: </label>
						<input type='password' name='nuova_password' placeholder='Nuova password'/>
						<br>
						<label for='conferma'>Conferma psw: </label>
						<input type='password' name='conferma' placeholder='Confermare nuova psw'/>
						<br><br>
						<input type='submit' id='submit' value='Cambia'>
					</form>
					<?php }?>
					<br>
					<a id='submit' href='impostazioni.php' style='text-decoration:none;color:white'>Premi per tornare indietro</a>
				</div>
			</div>
		</div>
	</body>
</html>