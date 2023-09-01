<?php
	include "dbconfig/dbconfig.php";
	$dbconn=mysqli_connect($dbhost,$dbuser,$dbpass) or die ("ERRORE connessione");
	mysqli_select_db($dbconn,$dbnome) or die ("NON ESISTE IL DATABASE");
?>