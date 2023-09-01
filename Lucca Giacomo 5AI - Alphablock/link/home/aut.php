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
			$_SESSION['data'] = date('Y-m-d H:i:s',strtotime('+1 hour',strtotime(date('Y-m-d H:i:s'))));
	}
	
	if(isset($_GET['nome'])&&isset($_SESSION['utente']))
	{
		$_SESSION['id']=$_GET['nome'];
		header("Location:home.php");
	}
	else
		header("Location:../account/utente.php");
?>