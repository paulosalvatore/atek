<?php
	$incluirArquivos = "";
	$diretorioJSLib = "js/lib/";
	foreach(scandir($diretorioJSLib) as $c => $v)
		if($v != "." and $v != "..")
			$incluirArquivos .= '<script type="text/javascript" src="'.$diretorioJSLib.$v.'"></script>';
	$diretorioJSArquivos = "js/arquivos/";
	foreach(scandir($diretorioJSArquivos) as $c => $v)
		if($v != "." and $v != "..")
			$incluirArquivos .= '<script type="text/javascript" src="'.$diretorioJSArquivos.$v.'"></script>';
	$diretorioArquivos = "includes/arquivos/";
	foreach(scandir($diretorioArquivos) as $c => $v)
		if($v != "." and $v != "..")
			include($diretorioArquivos.$v);
?>