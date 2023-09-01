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
	
	function megacronologia()
	{
		include "dbconfig/dbopen.php";
		$query="select titolo,data_ora,nome
				from utente,guarda,film
				where utente.id=guarda.id
				and guarda.codfilm=film.codfilm
				and email='".$_SESSION['utente']."'
                order by data_ora desc,nome";
		echo "<table>
				<tr><th>Utente</th>
					<th>Film</th>
					<th>Data</th>
				</tr>";
		$tabella=mysqli_query($dbconn,$query) or die(mysqli_error($dbconn));
		while($riga=mysqli_fetch_array($tabella))
		{
			echo "<tr><td><strong>".$riga['nome']."</strong></td><td>".$riga['titolo']."</td><td>".$riga['data_ora']."</td></tr>";
		}
		echo "</table>";
		include "dbconfig/dbclose.php";
	}
	
	function utenti()
	{
		include "dbconfig/dbopen.php";
		$query="select nome,img
				from utente
				where email='".$_SESSION['utente']."'";
		$tabella=mysqli_query($dbconn,$query) or die (mysqli_error($dbconn));
		while($riga=mysqli_fetch_array($tabella))
		{
			echo '
					<div class="img">
						<img src="../../img/account/'.$riga['img'].'.png" width="50px"/>
						<br>
						<p>'.$riga['nome'].'</p>
					</div>';
		}
		include "dbconfig/dbclose.php";
	}
	
	function account()
	{
		include "dbconfig/dbopen.php";
		$query="select cognome,nome,dataisc,email
				from account
				where email='".$_SESSION['utente']."'";
		$tabella=mysqli_query($dbconn,$query) or die (mysqli_error($dbconn));
		if($riga=mysqli_fetch_array($tabella))
			echo "	<p style='float:left;margin-top:-10px'><strong>Email: </strong>".$riga['email']."<br>
					<strong>Data iscrizione: </strong>".$riga['dataisc']."<br>
					<strong>Nome: </strong>".$riga['nome']." ".$riga['cognome']."</p>";
		include "dbconfig/dbclose.php";
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
			<h1 class='intestazione-h1'>Impostazioni</h1>
			<div class="testo" style='margin-top:50px'>
				<h1 style='text-align:center;color:white'>Cronologia degli utenti</h1>
				<div class="cronologia">
					<?php megacronologia();?>
				</div>
				<hr>
				<div class='impostazioni'>
					<h1>Account</h1>
					<div class="imp">
						<p style="float:left"><strong>Utenti:</strong></p>
						<?php utenti();?>
						<div class="divimp" style="margin-top:125px">
							<hr><br>
							<?php account();?>
							<a href="email.php" style='margin-top:-10px'>Cambia email</a>
							<br>
							<a href="password.php" style='margin-top:-10px'>Cambia password</a>
							<br>
							<a id='remove' href="cancella.php"><strong>Cancella account</strong></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>