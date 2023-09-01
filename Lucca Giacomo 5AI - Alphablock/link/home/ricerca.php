<?php
	include "dbconfig/dbopen.php";
	$q = mysqli_real_escape_string($dbconn,$_GET["stringa"]);
	$risposta = "";
	$i=0;
	if (strlen($q) > 0)
	{
		$query ="SELECT codfilm,titolo 
				 FROM film WHERE titolo like '%$q%'
				 ORDER BY titolo;";
		$tabella=mysqli_query($dbconn,$query) or die (mysqli_error($dbconn));
		while ($riga = mysqli_fetch_array($tabella))
			if($i<5)
			{
				$risposta .="<a href='cerca.php?codfilm=".$riga['codfilm']."'>". $riga['titolo']."</a><BR>";
				$i++;
			}
			
		if($i<5)
		{
			$query ="select *
					from genere
					where nomeg like '%$q%'";
			$tabella=mysqli_query($dbconn,$query) or die (mysqli_error($dbconn));
			while ($riga = mysqli_fetch_array($tabella))
			if($i<5)
			{
				$risposta .="<a href='cerca.php?codg=".$riga['codg']."'>". $riga["nomeg"]."</a><BR>";
				$i++;
			}
		}	
			
			
		if($i<5)
		{
			$query ="SELECT codreg,nomer
							FROM regista 
							WHERE nomer like '%$q%'
							and nomer not in(select nomea
												from attore
												WHERE nomea like '%$q%')";
			$tabella=mysqli_query($dbconn,$query) or die (mysqli_error($dbconn));
			while ($riga = mysqli_fetch_array($tabella))
			if($i<5)
			{
				$risposta .="<a href='cerca.php?codreg=".$riga['codreg']."'>". $riga["nomer"]."</a><BR>";
				$i++;
			}
		}
		
		if($i<5)
		{
			$query ="SELECT codat,nomea
					FROM attore
					WHERE nomea like '%$q%'
					and nomea not in (select nomer
										from regista
										WHERE nomer like '%$q%')";
			$tabella=mysqli_query($dbconn,$query) or die (mysqli_error($dbconn));
			while ($riga = mysqli_fetch_array($tabella))
			if($i<5)
			{
				$risposta .="<a href='cerca.php?codat=".$riga['codat']."'>". $riga["nomea"]."</a><BR>";
				$i++;
			}
		}
		
		if($i<5)
		{
			$query ="SELECT codat,nomea
					FROM attore
					WHERE nomea like '%$q%'
					and nomea in (select nomer
										from regista
										WHERE nomer like '%$q%')";
			$tabella=mysqli_query($dbconn,$query) or die (mysqli_error($dbconn));
			while ($riga = mysqli_fetch_array($tabella))
			if($i<5)
			{
				$risposta .="<a href='cerca.php?entrambi_att=".$riga['codat']."'>". $riga["nomea"]."</a><BR>";
				$i++;
			}
		}
		
		if($i<5)
		{
			$query ="SELECT coddop,nomed
					FROM doppiatore
					WHERE nomed like '%$q%' 
					ORDER BY nomed";
			$tabella=mysqli_query($dbconn,$query) or die (mysqli_error($dbconn));
			while ($riga = mysqli_fetch_array($tabella))
			if($i<5)
			{
				$risposta .="<a href='cerca.php?coddop=".$riga['coddop']."'>". $riga["nomed"]."</a><BR>";
				$i++;
			}
		}
	}
	
	if ($risposta == "")
		echo "<a>Nessun nome trovato</a>";
	else
		echo $risposta;
	
	include "dbconfig/dbclose.php";
?>