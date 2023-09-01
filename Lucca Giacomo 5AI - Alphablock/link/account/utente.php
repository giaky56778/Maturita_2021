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
?>
<! DOCTYPE html>
<html>
	<head>
		<title>Utente</title>
		<meta charset="UTF-8"/>
		<link rel="stylesheet" type="text/css" href="../../css/style.css"/>
		<link rel="stylesheet" type="text/css" href="../../css/720style.css"/>
		<link rel="stylesheet" type="text/css" href="../../css/1080style.css"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="icon" href="../../img/icone/ico.png"/>
	</head>
	<body style="background-color:#1a1622;background-image:none;">
		<div class="contenitore" style='text-align:center'>
			<div class="clearfix">
				<h1 style='margin-bottom:50px'>Seleziona un utente</h1>
				<?php 
					if(isset($_SESSION['utente']))
					{
						$i=0;	
						$matrice=array();
						include "dbconfig/dbopen.php";
						$query="select `id`,`nome`, `bimbo`, `img`
								from utente
								where email='".$_SESSION['utente']."'
								order by img";
						$tabella=mysqli_query($dbconn,$query) or die(mysqli_error($dbconn));
						while($riga=mysqli_fetch_array($tabella))
						{
							echo '<div class="account">
									<img src="../../img/account/'.$riga['img'].'.png" usemap="#user'.$riga['0'].'" id="'.$riga['0'].'" width="150px"/>
									<map name="#user'.$riga['0'].'">
										<area alt="Account" title="'.$riga['nome'].'" href="../home/aut.php?nome='.$riga['id'].'" coords="0,0,500,500" shape="rect" id="rect'.$riga['0'].'">
									</map>
										<br>
										<p>'.$riga['nome'].'</p>
								</div>';
								for($k=0;$k<4;$k++)
									$matrice[$i][$k]=$riga[$k];
							$i++;
						}
						if(mysqli_num_rows($tabella)<5)
							echo "	<img src='../../img/account/aggiungi.png' width='200px' usemap='#aggiungi' id='aggiungi' style='float:left'>
									<map name='aggiungi'>
										<area alt='Aggiungi' title='aggiungi' href='aggiungi.php' coords='100,76,100' shape='circle'>
									</map>";
						include "dbconfig/dbclose.php";
						
						echo "<script>
								function modifica(modifica)
								{
									if(modifica.value==='modifica')
									{
										document.getElementById('mod').innerHTML='Salva';";
						for($j=0;$j<$i;$j++)
							echo"document.getElementById('".$matrice[$j][0]."').src='../../img/account/".$matrice[$j][3]."-modifica.png';
								 document.getElementById('rect".$matrice[$j][0]."').setAttribute('href', 'modifica.php?id=".$matrice[$j][0]."');";
						echo "modifica.value='ricarica';
								}
								else
								{";
						for($j=0;$j<$i;$j++)
							echo"document.getElementById('".$matrice[$j][0]."').src='../../img/account/".$matrice[$j][3].".png';
								 document.getElementById('rect".$matrice[$j][0]."').setAttribute('href', '../home/aut.php?nome=".$matrice[$j][0]."');";

						echo"modifica.value='modifica';
							document.getElementById('mod').innerHTML='Modifica';
								}
							}</script>";
					}
				?>
			</div>
			<div style="clear:both"></div>
			<br>
			<button onClick="modifica(this)" value='modifica' id='mod'>Modifica</button>
		</div>
	</body>
</html>