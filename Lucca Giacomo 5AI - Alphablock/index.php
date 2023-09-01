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
		header("Location:link/account/utente.php");
	
	function film()
	{
		include "dbconfig/dbopen.php";
		$query="select max(codfilm) as num
				from film";
		$tabella=mysqli_query($dbconn,$query) or die (mysqli_error($dbconn));
		if($riga=mysqli_fetch_array($tabella))
			$num=$riga['num'];
		$cod=rand(1,$num);
		$i=0;
		$query="select copertina,descrizione,titolo,film.codfilm,ad_bimbo,genere.codg as codg,nomeg,hour(durata) as ore, minute(durata) as min
			from film,genere
			where genere.codg=film.codg
			and film.codfilm='$cod'
			order by nomeg";
		$tabella=mysqli_query($dbconn,$query) or die(mysqli_error($dbconn));
		if($riga=mysqli_fetch_array($tabella))
		{
			echo "<h1 style='text-align:center;'>Cosa potresti vedere su questo sito</h1>
			  <div id='film'>
				<div style='height:100%;float:left'><img src='".$riga['copertina']."'/></div>
				<h2>".$riga['titolo']."</h2>
				<p style='text-align:justify;padding-right:10px'>".$riga['descrizione']."</p>
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
			echo"<p><b>Genere:</b> ".$riga['nomeg']."</p>
				<p style='margin-left:192px'><b>Regista:</b> ";
				//REGISTA
				$query="select nomer
						from regista,creato
						where regista.codreg=creato.codreg
						and codfilm=$cod";
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
						and codfilm=$cod";
				$tabella=mysqli_query($dbconn,$query) or die(mysqli_error($dbconn));
				$num=mysqli_num_rows($tabella);
				if($num!=0)
				{
									
					echo "</p>
							<p style='margin-left:192px'><strong>Attori:</strong> ";
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
						and codfilm=$cod";
				$tabella=mysqli_query($dbconn,$query) or die(mysqli_error($dbconn));
				$num=mysqli_num_rows($tabella);
				if($num!=0)
				{
									
					echo "</p>
							<p style='margin-left:192px'><strong>Doppiatori:</strong> ";
					while($r=mysqli_fetch_array($tabella))
					{
						if($i<$num-1)
							echo $r['nomed'].", ";
						else
							echo $r['nomed'];
						$i++;
					}
				}
			
		}
		echo "</p></div>";
		include "dbconfig/dbclose.php";
	}
?>
<! DOCTYPE html>
<html>
	<head>
		<title>Anteprima</title>
		<meta charset="UTF-8"/>
		<link rel="stylesheet" type="text/css" href="css/style.css"/>
		<link rel="stylesheet" type="text/css" href="css/720style.css"/>
		<link rel="stylesheet" type="text/css" href="css/1080style.css"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="icon" href="img/icone/ico.png"/>
	</head>
	<body style="background-color:#5027A3;background-image:none">
		<div class="contenitore">
			<div class="testo-home">
			<img src="img/icone/wp1945897.png" style="height: auto;width:100%;border:0;margin-bottom:100px;border-bottom:5px solid black"/>
				<div id='p'>
					<p>Iscriviti ad Alpha Block e potrai guardare diversi film famosi e potrai guardarli su tutti i dispositivi compatibili (PC, SmartTv, Smartphone, Tablet)
					<br></p>
				<nav id="login-index">
					<a href="link/account/registrazione.php" id='aa'>Clicca per Registrarti</a>
					<a href="link/account/login.php" id='ab'>Clicca per Loggarti</a>
				</nav>
				</div>
				<div class="box">
					<div class="abbonamento" id="a">
						<h1>Costo abbonamento</h1>
						<p><b>Gratis</b></p>
					</div>
					<div class="abbonamento">
						<h4>L'abbonamento comprende:</h4>
						<ul style="text-align:left">
							<li>Accesso al catalogo</li>
							<li>Fino a 5 utenti collegati</li>
							<li>Parental control</li>
						</ul>
					</div>
				</div>
				<div id="contenitore-film">
					<?php film(); ?>
				</div>
				<h1 style="text-align:center;color:white;margin-top:150px">Disponibile su</h1>
				<div class="dispotivo-div">
					<center><img class="dispostivo" src="img/icone/tv.png"></center>
					<h2>TV</h2>
					<p>Amazon Fire TV
						<br>Dispositivi con Android Tv
						<br>Apple TV
						<br>Chromecast
						<br>TV LG
						<br>Samsung
					</p>
				</div>
				<div class="dispotivo-div">
					<center><img class="dispostivo" src="img/icone/pc.png"></center>
					<h2>Computer</h2>
					<p>Chrome OS
						<br>MacOS
						<br>PC Windows
					</p>
				</div>
				<div class="dispotivo-div">
					<center><img class="dispostivo" src="img/icone/tablet.png"></center>
					<h2>Mobile e tablet</h2>
					<p>Tablet Amazon Fire
						<br>Telefoni e tablet Android
						<br>iPhone e iPad
					</p>
				</div>
			</div>
		</div>
	</body>
</html>