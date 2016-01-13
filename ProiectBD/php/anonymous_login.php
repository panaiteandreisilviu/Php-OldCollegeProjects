<?php 

	require 'databaseConnect.php';
	session_start();
	
	$_SESSION['NUME'] = "Anonymous";
	$_SESSION['PRENUME'] = "";
	$_SESSION['LOGGED_IN'] = true;

	header("Location: ../index.php");
	die();
?>