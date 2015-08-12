<?php
	$menuInfo = $Menus->pegarInformacoes($id);
	$submenu = $menuInfo["submenu"];
	$titulo = $menuInfo["descricao"];
	$ocultarTitulo = 1;
	$conteudo = $Menus->exibir($menuInfo["submenu"]);
	$corConteudo = "#FFFFFF";
?>