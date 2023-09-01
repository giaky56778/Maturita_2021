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
	
	function errore()
	{
		echo "	<div class='errore' style='float:left;color:white;margin-top:50px;padding:20px;height:100px'>
					<p><strong>ERRORE</strong> Impossibile cambiare eseguire l'operazione richiesta.</p>
					<a href='utente.php'>Clicca qui per tornare indietro</a>
				</div>";
	}
	
	if(isset($_GET['utente']))
	{
		include "dbconfig/dbopen.php";
		$query="UPDATE `utente` SET `nome`='".mysqli_real_escape_string($dbconn,$_GET['utente'])."'
				WHERE id='".$_GET['id']."'";
		mysqli_query($dbconn,$query) or die (errore());
		
		include "dbconfig/dbclose.php";
		header("Location:utente.php");
	}
?>
<! DOCTYPE html>
<html>
	<head>
		<title>Aggiungi</title>
		<meta charset="UTF-8"/>
		<link rel="stylesheet" type="text/css" href="../../css/style.css"/>
		<link rel="stylesheet" type="text/css" href="../../css/720style.css"/>
		<link rel="stylesheet" type="text/css" href="../../css/1080style.css"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
		<link rel="icon" href="../../img/icone/ico.png"/>
	</head>	
	<body style="background-color:#1a1622;background-image:none;">
		<div class="contenitore">
		<?php
			if(isset($_GET['id']))
			{
				include "dbconfig/dbopen.php";
				$query="select img,nome
						from utente
						where email='".$_SESSION['utente']."'
						and id=".$_GET['id'];
				$tabella=mysqli_query($dbconn,$query) or die(errore());
				if($riga=mysqli_fetch_array($tabella))
				{
		?>
			<div class="utente">
				<h1>Modifica profilo</h1>
				<form action="modifica.php" method="GET">
					<img src='../../img/account/<?php echo $riga['img']; ?>.png' />
					<br>
					<label for='utente' style='color:white'>Nome: </label>
					<input type="text" name="utente" value="<?php echo $riga['nome']?>" style="margin-top:-25px"/>
					<input type='hidden' name="id" value="<?php echo $_GET['id'];?>"/>
					<br><br>
					<a href='rimuovi.php?id=<?php echo $_GET['id'];?>' id='cancella'>Cancella Profilo <i class="fa fa-trash" aria-hidden="true"></i></a>
					<br><br>
					<input type="submit" id="submit" value="Salva"/>
				</form>
			</div>
			<?php
				}
				include "dbconfig/dbclose.php";
			}else
				errore();
			?>
		</div>
	</body>
</html>