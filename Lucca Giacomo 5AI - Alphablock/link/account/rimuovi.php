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
	
	if(!isset($_SESSION['utente']))
		header("Location:login.php");
	
	if(isset($_GET['id'])&&isset($_SESSION['utente']))
	{
		include "dbconfig/dbopen.php";
		$query='DELETE FROM `utente` WHERE id='.$_GET['id'].' and email="'.$_SESSION['utente'].'"';
		mysqli_query($dbconn,$query) or die(errore());
		$query="UPDATE `account` SET `n_ut_reg`=n_ut_reg-1
					WHERE email='".$_SESSION['utente']."'";
		mysqli_query($dbconn,$query) or die(errore());
		$query='DELETE FROM guarda WHERE id='.$_GET['id'];
		mysqli_query($dbconn,$query) or die(errore());
		include "dbconfig/dbclose.php";
		header("Location:utente.php");
	}
	else
		errore();
	
	function errore()
	{
?>

<! DOCTYPE html>
<html>
	<head>
		<title>Elimina</title>
		<meta charset="UTF-8"/>
		<link rel="stylesheet" type="text/css" href="../style.css"/>
		<link rel="icon" href="../../img/icone/ico.png"/>
	</head>
	<body style="background-color:rgba(0,15,30,0.9)">
		<div class="contenitore">
			<div class='errore' style='color:white;margin-top:50px;padding:20px;height:100px'>
			<p><strong>ERRORE</strong> Impossibile cancellare l'account</p>
			<a href='utente.php'>Clicca qui per tornare indietro</a>
		</div>
		</div>
	</body>
</html>

<?php }?>