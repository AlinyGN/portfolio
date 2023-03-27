<?php
ini_set( 'display_errors', true );
error_reporting( E_ALL );
//variáveis da consulta
$host = "host";
$db = "nome_do_banco";
$user = "usuario_do_banco";
$pass = 'senha';
//conexão com a hospedagem
$con = mysqli_connect($host,$user,$pass)
			or die(mysqli_connect_error($con));
//seleciona o banco de dados
$database = mysqli_select_db($con,$db) or die(mysqli_error($con));

?>
