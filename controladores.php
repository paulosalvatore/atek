<?php
	session_start();
	require_once("conexao/conexao.php");
	include("includes/iniciarClasses.php");
	include("includes/incluirArquivos.php");
	$Funcao->checarAjax(__FILE__);
	foreach($_REQUEST as $c => $v)
		$$c = $v;
	if($formulario)
		$formulario = $Funcao->separarForm($formulario, true);
	$validarControlador = $Funcao->validarControlador($controlador);
	include($validarControlador);
?>