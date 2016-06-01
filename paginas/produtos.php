<?php
	$anuncio = $Anuncios->pegarInformacoes($id);
	$anuncioInfo = $anuncio["info"];
	$categoriaInfo = $Categorias->pegarInformacoes($anuncioInfo["categoria"]);
	$submenu = $categoriaInfo["menu"];
	$barraNavegacao = $Anuncios->carregarBarraNavegacao($anuncioInfo, $categoriaInfo);
	$titulo = $anuncioInfo["descricao"];
	$ordemTituloBarra = 2;
	$conteudo = $Anuncios->exibirAnuncio($id);
	$corConteudo = "#FFFFFF";
?>