<?php
	$incluirArquivos = "";
	$diretorioJSLib = "js/lib/";
	foreach(scandir($diretorioJSLib) as $c => $v)
		if($v != "." and $v != "..")
			$incluirArquivos .= '<script type="text/javascript" src="'.$diretorioJSLib.$v.'"></script>';
?>