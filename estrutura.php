<?php
	include("includes/incluirArquivos.php");
	$diretorioJSPaginas = "js/paginas/";
	if(is_file($diretorioJSPaginas.$pagina.".js"))
		$incluirArquivos .= '<script type="text/javascript" src="'.$diretorioJSPaginas.$pagina.'.js"></script>';
	echo'
		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml">
			<head>
				<title>ATEK FLASH SYSTEM - ILUMINAÇÃO PROFISSIONAL PARA FOTOGRAFIA</title>
				<link rel="shortcut icon" href="http://www.atek.com.br/favicon.ico" />
				<link rel="stylesheet" type="text/css" href="css/fontes.css" />
				<link rel="stylesheet" type="text/css" href="css/style.css" />
				<link rel="stylesheet" type="text/css" href="css/jquery-ui.css" />
				<link rel="stylesheet" type="text/css" href="css/jquery-te.css" />
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
							<div id="banner">
								';
								// <iframe width="100%" height="230" src="http://qgbrain.com.br/web/tieri/videos.html" frameborder="0"></iframe>
								echo'
							</div>
							<table width="100%" cellpadding="0" cellspacing="0" id="boxBusca">
								<tr>
									<td width="50%" id="aviso">
										'.$Estrutura->exibirAviso().'
									</td>
									<td>
										<input type="text" id="consultaProdutos" onClick="this.select();" value="'.$consulta.'" placeholder="Buscar Produtos" />
										<input type="button" id="buscarProdutos" value="Buscar" />
										<div id="botaoOrcamento">
											<img src="imagens/conteudo/orcamento.jpg" alt="" />
										</div>
									</td>
								</tr>
							</table>
							'.$Estrutura->exibirPagina($pagina).'
						</td>
					<tr>
				<table>
				'.$Estrutura->exibirRodape().'
			</body>
		</html>
	';
?>