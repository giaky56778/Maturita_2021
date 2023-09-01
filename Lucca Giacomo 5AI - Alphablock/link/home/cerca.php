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
	
	if(isset($_SESSION['utente']))
	{
		include "dbconfig/dbopen.php";
		$bimbo;
		$query='select nome,img,bimbo
				from utente
				where email="'.$_SESSION['utente'].'"
				and id='.$_SESSION['id'];
		$tabella=mysqli_query($dbconn,$query) or die (mysqli_error($dbconn));
		if(mysqli_num_rows($tabella)==0)
			header("Location:../account/utente.php");
		if($riga=mysqli_fetch_array($tabella))
		{
			$nome=$riga['nome'];
			$img=$riga['img'];
			$bimbo=$riga['bimbo'];
		}
		include "dbconfig/dbclose.php";
	}
	else
		header("Location:../account/login.php");
	
	if(isset($_GET['codfilm']))
		header("Location:film.php?codfilm=".$_GET['codfilm']);
?>

<! DOCTYPE html>
<html>
	<head>
		<title>Home</title>
		<meta charset="UTF-8"/>
		<link rel="stylesheet" type="text/css" href="../../css/style.css"/>
		<link rel="stylesheet" type="text/css" href="../../css/720style.css"/>
		<link rel="stylesheet" type="text/css" href="../../css/1080style.css"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
		<link rel="icon" href="../../img/icone/ico.png"/>
		<script src="cerca.js"></script>
	</head>
	<body style="background-image:url(../../img/icone/Reb777a35191ea1feaae5d00eabab77f4.jpg);background-attachment:fixed;background-size:cover;background-repeat: no-repeat;">
		<div class="contenitore">
			<div class="nav">
				<img src='../../img/icone/logo.png' alt='Logo' width='150px' style="float:left;"/>
				<div class='searchbar'>
					<i class="fas fa-search"></i>
					<input type="input" id='cerca' placeholder='Cerca' onkeyup="mostra(this.value)"/>
				</div>
				<div class="dropdown">
					<p style="float:left;margin-left:20px"><strong><?php echo $nome;?></strong> &nbsp;<i class="fas fa-sort-down"></i></p>
					<img src='../../img/account/<?php echo $img;?>.png' width="50px" style="float:right">
					<div class="dropdown-content">
						<a href='../account/utente.php'>Cambia utente <i class="fas fa-user-circle"></i></a>
						<br><br>
						<a href="../account/impostazioni.php">Impostazioni <i class="fas fa-clipboard-list"></i></a>
						<br><br>
						<a href="../account/logout.php">Logout <i class="fas fa-sign-out-alt"></i></a>
					</div>
				</div>
				<div id='risposta'>
				</div>
				</div>
			<br>
			<a href="home.php" id='guarda'>Torna alla home</a>
			<div class="testo" style="margin-top:50px;">
				<?php
					if(isset($_GET['codg'])||isset($_GET['codreg'])||isset($_GET['codat'])||isset($_GET['coddop']))
					{
						$b=0;
						echo "<h1 id='anguria' style='color:white'>Ricerca attraverso ";
						if(isset($_GET['codg']))
						{
							$query="select titolo,codfilm,copertina,ad_bimbo
									from film
									where codg=".$_GET['codg'];
							echo "genere";
						}
						if(isset($_GET['codreg']))
						{
							$query="select titolo,film.codfilm,copertina,ad_bimbo
									from film,creato
									where film.codfilm=creato.codfilm
									and codreg=".$_GET['codreg'];
							echo "regista";
						}
						if(isset($_GET['codat']))
						{
							$query="select titolo,film.codfilm,copertina,ad_bimbo
									from film,partecipa
									where film.codfilm=partecipa.codfilm 
									and codat=".$_GET['codat'];
							echo "attore";
						}
						if(isset($_GET['coddop']))
						{
							$query="select titolo,film.codfilm,copertina,ad_bimbo
									from film,doppiato
									where film.codfilm=doppiato.codfilm 
									and coddop=".$_GET['coddop'];
							echo "doppiatore";
						}
						echo "</h1>";
						include "dbconfig/dbopen.php";
						$tabella=mysqli_query($dbconn,$query) or die (mysqli_error($dbconn));
						$num=mysqli_num_rows($tabella);
						if($num!=0)
						{
							while($riga=mysqli_fetch_array($tabella))
								if(($riga['ad_bimbo']<$bimbo||($bimbo==0)))
								{
									echo "<div class='seleziona-film'>
											<img src='../../".$riga['copertina']."' usemap='#film".$riga['codfilm']."'/>
											<span><strong>".$riga['titolo']."</strong></span>
											<map name='#film".$riga['codfilm']."'>
												<area coords='0,0,1000,1000' shape='rect' href='film.php?codfilm=".$riga['codfilm']."'/>
											</map>
										</div>";
										$b++;
								}
						}
						if($b==0)
							echo "<div class='errore'>
										<p><strong>ERRORE</strong> Non sono presenti film con questi criteri.</p>
									</div>";
						include "dbconfig/dbclose.php";
					}
					
					if(isset($_GET['entrambi_att']))
					{
						
						$b=0;
						include "dbconfig/dbopen.php";
						echo "<h1 style='color:white'>Ricerca attraverso attore e registi (attori)</h1>";
						$query="select titolo,film.codfilm as codfilm,copertina,ad_bimbo
								from film,partecipa
								where film.codfilm=partecipa.codfilm
								and codat=".$_GET['entrambi_att'];
						$tabella=mysqli_query($dbconn,$query) or die ($dbconn);
						$num=mysqli_num_rows($tabella);
						if($num!=0)
						{
							while($riga=mysqli_fetch_array($tabella))
								if(($riga['ad_bimbo']<$bimbo||($bimbo==0)))
								{
									echo "<div class='seleziona-film'>
											<img src='../../".$riga['copertina']."' usemap='#film".$riga['codfilm']."'/>
											<span><strong>".$riga['titolo']."</strong></span>
											<map name='#film".$riga['codfilm']."'>
												<area coords='0,0,1000,1000' shape='rect' href='film.php?codfilm=".$riga['codfilm']."'/>
											</map>
										</div>";
										$b++;
								}
						}
						
						$query="select titolo,film.codfilm as codfilm,copertina,ad_bimbo
								from film,creato,regista
								where film.codfilm=creato.codfilm
								and creato.codreg=regista.codreg
								and nomer = (select nomea
											from attore
											where codat=".$_GET['entrambi_att'].")
								and film.codfilm not in (select film.codfilm
														from film,partecipa
								where film.codfilm=partecipa.codfilm
								and codat=".$_GET['entrambi_att'].")";
						$tabella=mysqli_query($dbconn,$query) or die ($dbconn);
						$num=mysqli_num_rows($tabella);
						if($num!=0)
						{
							echo "<br><h1 style='color:white'>Ricerca attraverso attore e registi (regista)</h1>";
							while($riga=mysqli_fetch_array($tabella))
								if(($riga['ad_bimbo']<$bimbo||($bimbo==0)))
								{
									echo "<div class='seleziona-film'>
											<img src='../../".$riga['copertina']."' usemap='#film".$riga['codfilm']."'/>
											<span><strong>".$riga['titolo']."</strong></span>
											<map name='#film".$riga['codfilm']."'>
												<area coords='0,0,1000,1000' shape='rect' href='film.php?codfilm=".$riga['codfilm']."'/>
											</map>
										</div>";
										$b++;
								}
						}
						if($b==0)
							echo "<div class='errore'>
										<p><strong>ERRORE</strong> Non sono presenti film con questi criteri.</p>
									</div>";
						include "dbconfig/dbclose.php";
							
					}
						
				?>
			</div>
		</div>
	</body>
</html>