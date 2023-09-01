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
	
	if(!isset($_GET['codfilm']))
		header("Location:home.php");
	
	
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
	<body>
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
			</div>
			<div class="testo">
				<?php 
					if(isset($_GET['codfilm']))
					{
						include "dbconfig/dbopen.php";
						$matrice;
						$i=0;
						$query="select copertina,descrizione,titolo,film.codfilm,ad_bimbo,genere.codg as codg,nomeg,hour(durata) as ore, minute(durata) as min
								from film,genere
								where genere.codg=film.codg
								and film.codfilm='".$_GET['codfilm']."'
								order by nomeg";
						$tabella=mysqli_query($dbconn,$query) or die(mysqli_error($dbconn));
						if($riga=mysqli_fetch_array($tabella))
						{
							$cod=$riga['codg'];
							if($riga['ad_bimbo']<$bimbo||($bimbo==0))
							{
								echo "<div class='visualizzo_film'>
										<img src='../../".$riga['copertina']."' style=''/>
										<h1>".$riga['titolo']."</h1>
										<p>".$riga['descrizione']."</p>
										<p><strong>Durata del film:</strong> ";
								
								if(intval($riga['ore'])>0)
								{
									echo $riga['ore'];
									if(intval($riga['ore'])!=1)
										echo " ore ";
									else
										echo " ora ";
								}
								if(intval($riga['min'])>0)
								{
									echo "e ".$riga['min'];
									if(intval($riga['min'])!=1)
										echo " minuti</p>";
									else
										echo " minut0</p>";
								}
								else
									echo "</p>";
								echo"	<p><b>Genere:</b> ".$riga['nomeg']."</p>
										<p><b>Regista:</b> ";
								
								//REGISTA
								$query="select nomer
										from regista,creato
										where regista.codreg=creato.codreg
										and codfilm=".$_GET['codfilm'];
								$tabella=mysqli_query($dbconn,$query);
								$num=mysqli_num_rows($tabella);
								while($r=mysqli_fetch_array($tabella))
								{
									if($i<$num-1)
										echo $r['nomer'].", ";
									else
										echo $r['nomer'];
									$i++;
								}
								
								//ATTORI
								$i=0;
								$query="select nomea
									from attore,partecipa
									where attore.codat=partecipa.codat
									and codfilm=".$_GET['codfilm'];
								$tabella=mysqli_query($dbconn,$query) or die(mysqli_error($dbconn));
								$num=mysqli_num_rows($tabella);
								if($num!=0)
								{
									
									echo "</p>
											<p><strong>Attori:</strong> ";
									while($r=mysqli_fetch_array($tabella))
									{
										if($i<$num-1)
											echo $r['nomea'].", ";
										else
											echo $r['nomea'];
										$i++;
									}
								}
								
								//DOPPIATORI
								$i=0;
								$query="select nomed
									from doppiatore,doppiato
									where doppiato.coddop=doppiatore.coddop
									and codfilm=".$_GET['codfilm'];
								$tabella=mysqli_query($dbconn,$query) or die(mysqli_error($dbconn));
								$num=mysqli_num_rows($tabella);
								if($num!=0)
								{
									
									echo "</p>
											<p><strong>Doppiatori:</strong> ";
									while($r=mysqli_fetch_array($tabella))
									{
										if($i<$num-1)
											echo $r['nomed'].", ";
										else
											echo $r['nomed'];
										$i++;
									}
								}
								echo "</p><br>
									  <a href='guarda.php?codfilm=".$riga['codfilm']."' id='guarda' target='_blank'>Guarda</a>
									  <a href='home.php' style='float:right;margin-right:25px'>Torna indietro</a>
								    </div>";
							}
							else 
								echo"<div class='errore' style='margin-top:50px;height:100px'>
										<p><strong>ERRORE</strong> Impossibile guardare il film.</p>
										<a href='home.php'>Clicca per tornare indietro</a>
									</div>";
						}
						
						
						//altri film
						$k=0;
						$query="select titolo,nomeg,codfilm,copertina,ad_bimbo
								from film,genere
								where film.codg=genere.codg
								and film.codg=$cod
								and codfilm!=".$_GET['codfilm'];
						$tabella=mysqli_query($dbconn,$query) or die (mysqli_error($dbconn));
						$num=mysqli_num_rows($tabella);
						if($num!=0)
						{
							while($riga=mysqli_fetch_array($tabella))
								if(($riga['ad_bimbo']<$bimbo||($bimbo==0))&&$k<20)
								{
									if($k==0)
									{
										echo "<div class='genere' style='margin-top:75px'>
												<h2>Altri film dello stesso genere</h2>";
										$i++;
									}
									echo "<div class='seleziona-film'>
											<img src='../../".$riga['copertina']."' usemap='#film".$riga['codfilm']."'/>
											<span><strong>".$riga['titolo']."</strong></span>
											<map name='#film".$riga['codfilm']."'>
												<area coords='0,0,1000,1000' shape='rect' href='film.php?codfilm=".$riga['codfilm']."'/>
											</map>
										</div>";
									$k++;
								}
							if($k!=0)	
								echo "</div>";
						}
						include "dbconfig/dbclose.php";
					}
				?>
			</div>
		</div>
	</body>
</html>