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
			$_SESSION['data'] = date('Y-m-d H:i:s',strtotime('+1 hour',strtotime(date('Y-m-d H:i:s'))));
	}
	
	if(isset($_GET['codfilm']))
	{
		include "dbconfig/dbopen.php";
		$bimbo;
		$link;
		$query='select bimbo
				from utente
				where email="'.$_SESSION['utente'].'"
				and id='.$_SESSION['id'];
		$tabella=mysqli_query($dbconn,$query) or die (mysqli_error($dbconn));
		if($riga=mysqli_fetch_array($tabella))
			$bimbo=$riga['bimbo'];
		
			
		$query="select titolo,link,ad_bimbo
				from film
				where codfilm='".$_GET['codfilm']."'";
		$tabella=mysqli_query($dbconn,$query);
		if($riga=mysqli_fetch_array($tabella))
			if($riga['ad_bimbo']<$bimbo||($bimbo==0))
			{
				$titolo=$riga['titolo'];
				$link=$riga['link'];
				
				$query="insert into guarda
						values(".$_SESSION['id'].",".$_GET['codfilm'].",now())";
				mysqli_query($dbconn,$query) or die(mysqli_Error($dbconn));
			}
			else 
				header("Location:home.php");
			
			
		include "dbconfig/dbclose.php";
	}
	else
		header("Location:film.php");
	
?>
<! DOCTYPE html>
<html>
	<head>
		<title><?php echo $titolo;?></title>
		<meta charset="UTF-8"/>
		<link rel="stylesheet" type="text/css" href="../../style.css"/>
		<link rel="icon" href="../../img/icone/ico.png"/>
	</head>
	<body>
		<div class="contenitore">
		<iframe width="100%" height="100%" src="https://www.youtube.com/embed/<?php echo $link;?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
		</div>
	</body>
</html>