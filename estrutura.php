<?php
	include("includes/incluirArquivos.php");
	echo'
		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml">
			<head>
				<title>ATEK FLASH SYSTEM - ILUMINAÇÃO PROFISSIONAL PARA FOTOGRAFIA</title>
				<link rel="shortcut icon" href="http://www.atek.com.br/favicon.ico"/>
				<link rel="stylesheet" type="text/css" href="css/fontes.css"/>
				<link rel="stylesheet" type="text/css" href="css/style.css"/>
				'.$incluirArquivos.'
			</head>
			<body>
				<div style="height: 229px;">
					<div id="menuPrincipal" align="center">
						'.$Estrutura->exibirMenuPrincipal().'
					</div>
					'.$Estrutura->exibirCabecalho().'
				</div>
				<table width="100%" cellspacing="0" cellpadding="0" style="table-layout: fixed;">
					<tr valign="top">
						<td id="menuEsquerdo">
							'.$Estrutura->exibirMenuEsquerdo().'
						</td>
						<td id="conteudo">
						</td>
					<tr>
				<table>
				'.$Estrutura->exibirRodape().'
			</body>
		</html>
	';
?>