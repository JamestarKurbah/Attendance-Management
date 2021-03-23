<?php
	$pagetitle="Home Page";
	require "Config.php";
	session_start(); 
	require "include\header.php";
	header("location: home.php");
?>