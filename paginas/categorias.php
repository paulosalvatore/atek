<?php
	$categoriaInfo = $Categorias->pegarInformacoes($id);
	$submenu = $categoriaInfo["menu"];
	$barraNavegacao = $Categorias->carregarBarraNavegacao($categoriaInfo);
	$titulo = $categoriaInfo["descricao"];
	$ocultarTitulo = 1;
	$conteudo = $Anuncios->exibir($id, "categorias");
	$corConteudo = "#FFFFFF";
?>