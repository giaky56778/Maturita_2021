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
		$nome;
		$img;
		$query='select nome,img
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
		}
		include "dbconfig/dbclose.php";
	}
	else
		header("Location:../account/login.php");
	
	function cronologia()
	{
		include "dbconfig/dbopen.php";
		$i=0;
		$matrice;
		$query="select distinct titolo,film.codfilm,copertina
			from guarda,film
			where guarda.codfilm=film.codfilm
			and id=".$_SESSION['id'];
		$tabella=mysqli_query($dbconn,$query) or die(mysqli_error($dbconn));
		while($riga=mysqli_fetch_array($tabella))
		{
			$query="select max(data_ora) as data
					from guarda
					where codfilm=".$riga['codfilm'];
			$tab=mysqli_query($dbconn,$query);
			if($r=mysqli_fetch_array($tab))
			{
				$matrice[$i]=$riga;
				$matrice[$i][3]=$r;
				$i++;
			}
		}
		for($j=0;$j<$i;$j++)
			for($k=0;$k<$i-1;$k++)
			{
				if($matrice[$k][3]<$matrice[$k+1][3])
				{
					$temp=$matrice[$k];
					$matrice[$k]=$matrice[$k+1];
					$matrice[$k+1]=$temp;
				}
			}
		if(isset($matrice))
		{
			$i=0;
			if(sizeof($matrice)<8)
				$num=sizeof($matrice);
			else
				$num=8;
			while($i<$num)
			{
				if($i==0)
					echo "<div class='genere'>
							<h2>Cronologia</h2>"; 
				echo "<div class='seleziona-film'>
						<img src='../../".$matrice[$i]['copertina']."' usemap='#cronologia".$matrice[$i]['codfilm']."'/>
						<span><strong>".$matrice[$i]['titolo']."</strong></span>
						<map name='#cronologia".$matrice[$i]['codfilm']."'>
							<area coords='0,0,1000,1000' shape='rect' href='film.php?codfilm=".$matrice[$i]['codfilm']."'/>
						</map>
					</div>";
				
			$i++;
			}
			if($i!=0)
				echo "</div>";
			include "dbconfig/dbclose.php";
		}
	}
	
	
	function banner()
	{
		$k=0;
		$i=1;
		$matrice;
		
		include "dbconfig/dbopen.php";
		//parental control
		$bimbo;
		$query='select bimbo
				from utente
				where email="'.$_SESSION['utente'].'"
				and id='.$_SESSION['id'];
		$tabella=mysqli_query($dbconn,$query) or die (mysqli_error($dbconn));
		if($riga=mysqli_fetch_array($tabella))
			$bimbo=$riga['bimbo'];
		
		
		if($bimbo==0)
			$query="select count(*) as num
					from film";
		else
			$query="select count(*) as num
				from film
				where ad_bimbo=0";
		$tabella=mysqli_query($dbconn,$query) or die(mysqli_error($dbconn));
		
		
		if($bimbo==0)
			$query="select titolo,banner,codfilm
					from film";
		else
			$query="select titolo,banner,codfilm
					from film
					where ad_bimbo=0";
		$tabella=mysqli_query($dbconn,$query) or die (mysqli_error($dbconn));
		while($riga=mysqli_fetch_array($tabella))
		{
			$matrice[$k]=$riga;
			$k++;
		}
		
		
		echo "
			<div class='banner'>
					<img src='' id='banner' usemap='#banner'/>
					<map name='#banner'>
						<area href='' coords='0,0,750,750' shape='rect' id='mappa'/>
					</map>
					<p id='titolo'> </p>
			  </div>
			  
			  
			<script>
				film$i();
				";
		$num=rand(0,sizeof($matrice)-6);
		while($i<=5)
		{

			echo"function film$i()";
			echo'	{
					document.getElementById("banner").src="../../'.$matrice[$i+$num]["banner"].'";
					document.getElementById("titolo").innerHTML="'.$matrice[$i+$num]["titolo"].'";
					document.getElementById("mappa").setAttribute("href","film.php?codfilm='.$matrice[$i+$num]["codfilm"].'");';
			echo"	setTimeout(film";
			if($i==5)
				echo '1';	
			else
				echo ($i+1);
			echo ", 5000);
				}
				";
			$i++;
		}
		echo '
			document.getElementById("titolo").innerHTML="'.$matrice[$num+1]["titolo"].'";
			document.getElementById("banner").src="../../'.$matrice[$num+1]["banner"].'";
			document.getElementById("mappa").setAttribute("href","film.php?codfilm='.$matrice[$num+1]["codfilm"].'");
			</script>
			';
		include "dbconfig/dbclose.php";
	}
	
	
	function film()
	{
		include "dbconfig/dbopen.php";
		$matrice;
		$temp;
		//generi
		$j=0;
		$query="select *
				from genere";
		$tabella=mysqli_query($dbconn,$query) or die (mysqli_error($dbconn));
		while($riga=mysqli_fetch_array($tabella))
		{
			$matrice[$j]=$riga;
			$j++;
		}
		$size=rand(0,sizeof($matrice)-5);
		
		//parental control
		$bimbo;
		$query='select bimbo
				from utente
				where email="'.$_SESSION['utente'].'"
				and id='.$_SESSION['id'];
		$tabella=mysqli_query($dbconn,$query) or die (mysqli_error($dbconn));
		if($riga=mysqli_fetch_array($tabella))
			$bimbo=$riga['bimbo'];
		
		
		//film suddivisi per genere
		$j=0;
		$i=0;
		while($i<5&&sizeof($matrice)-$size>$j)
		{
			$k=0;
			$query="select titolo,nomeg,codfilm,copertina,ad_bimbo
					from film,genere
					where film.codg=genere.codg
					and film.codg=".$matrice[$j+$size]['codg'];
			$tabella=mysqli_query($dbconn,$query) or die (mysqli_error($dbconn));
			$num=mysqli_num_rows($tabella);
			if($num!=0)
			{
				while($riga=mysqli_fetch_array($tabella))
					if(($riga['ad_bimbo']<$bimbo||($bimbo==0))&&$k<20)
					{
						if($k==0)
						{
							echo "<div class='genere'>
									<h2>".$matrice[$j+$size]['nomeg']."</h2>";
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
				$j++;
			}
		}
		$j=0;
		while($i<5)
		{
			$k=0;
			$query="select titolo,nomeg,codfilm,copertina,ad_bimbo
					from film,genere
					where film.codg=genere.codg
					and film.codg=".$matrice[$j]['codg'];
			$tabella=mysqli_query($dbconn,$query) or die (mysqli_error($dbconn));
			$num=mysqli_num_rows($tabella);
			if($num!=0)
			{
				while($riga=mysqli_fetch_array($tabella))
					if(($riga['ad_bimbo']<$bimbo||($bimbo==0))&&$k<20)
					{
						if($k==0)
						{
							echo "<div class='genere'>
									<h2>".$matrice[$j]['nomeg']."</h2>";
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
				$j++;
			}
		}
		include "dbconfig/dbclose.php";
	}
?>
<! DOCTYPE html>
<html class="html">
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
			<div class="nav" style="">
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
			<div class="testo">
				<h1 id='h1'>Film consigliati</h1>
				<?php banner();?>
				<?php cronologia();?>
				<?php film();?>
			</div>
		</div>
	</body>
</html>