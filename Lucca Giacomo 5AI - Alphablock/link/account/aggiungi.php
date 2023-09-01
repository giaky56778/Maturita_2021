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
		<link rel="icon" href="../../img/icone/ico.png"/>
	</head>
	<body style="background-color:#1a1622;background-image:none;">
		<div class="contenitore">
		<?php
			$riga[0]=0;
			$i=1;
			include "dbconfig/dbopen.php";
			$query="select img
					from utente
					where email='".$_SESSION['utente']."'
					order by img";
			$tabella=mysqli_query($dbconn,$query) or die(mysqli_error($dbconn));
			while($temp=mysqli_fetch_array($tabella))
			{
				$riga[$i]=$temp['img'];
				$i++;
			}
			$riga[$i]=$riga[$i-1]+1;
			
			for($j=0;$j<$i;$j++)
				if($riga[$j]+1!=$riga[$j+1])
					$img=$riga[$j]+1;
			if(!isset($img))
				$img=$riga[$j];
		
			if($img<=5)
			{
				aggiungi();
		?>
			<div class="utente">
				<form action="aggiungi.php" method="GET">
					<img src='../../img/account/<?php echo $img; ?>.png' width='150px'/>
					<input type='hidden' name='img' value='<?php echo $img; ?>'/>
					<br>
					<input type="text" name="utente" placeholder="Nome utente" style="margin-top:-25px"/>
					<br>
					<label for="filtro" style="color:white;">Parental Control </label>
					<input type="checkbox" name="filtro" style="margin-right:20px"/>
					<input type="submit" id="submit" value="Registra"/>
				</form>
			</div>
			<?php
			}
			else
				echo "	<div class='errore' style='color:white;margin-top:50px;padding:20px;height:100px'>
							<p><strong>ERRORE</strong> Impossibile aggiungere un nuovo utente o account non valido.</p>
							<a href='utente.php'>Clicca qui per tornare indietro</a>
						</div>";
			include "dbconfig/dbclose.php";
			
			
			
			
			function aggiungi()
			{
				include "dbconfig/dbopen.php";
				if(isset($_GET['utente']))
					if($_GET['utente']!='')
					{
						if(isset($_GET['filtro']))
							$filtro=1;
						else 
							$filtro=0;
						$query="INSERT INTO `utente`(`email`, `nome`, `bimbo`, `img`) values
								('".$_SESSION['utente']."',
								'".mysqli_real_escape_string($dbconn,$_GET['utente'])."',
								$filtro,'".$_GET['img']."')";
						mysqli_query($dbconn,$query) or die(errore());
						
						$query="UPDATE `account` SET `n_ut_reg`=n_ut_reg+1
								WHERE email='".$_SESSION['utente']."'";
						mysqli_query($dbconn,$query) or die(errore());
						include "dbconfig/dbclose.php";
						header("Location:utente.php");
					}
					else
						errore();
			}
			
			function errore()
			{
				echo "	<div class='errore' style='color:white;padding:20px'>
							<p><strong>ERRORE!</strong> Impossibile registrare l'utente.</p>
						</div>";
			}
			?>
		</div>
	</body>
</html>