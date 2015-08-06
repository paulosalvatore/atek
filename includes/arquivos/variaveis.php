<?php
	// $ca = $_COOKIE["ca"];
	// $login = $_SESSION["login"];
	$p = explode("-", $_REQUEST["p"]);
	$pagina = ($p[0] ? $p[0] : "principal");
	$id = $p[1];
	$opcoes_adicionais = $p[2];
	$consulta = utf8_decode($_REQUEST["c"]);
	// $opcoes = $_COOKIE["o"];
	// $ultima_categoria = $_COOKIE["uc"];
	// $ro_inicial = $_COOKIE["ro"];
	// if(!is_numeric($ro_inicial))
		// $ro_inicial = 0;
	// if(empty($opcoes))
		// $opcoes = "000";
	// $variaveis_busca = $_REQUEST["v"];
?>