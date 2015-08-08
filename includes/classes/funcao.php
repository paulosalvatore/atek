<?php
	class Funcao {
		public function limparString($string){
			$a = "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr' ";
			$b = "AAAAAAACEEEEIIIIDNOOOOOOUUUUYBSaaaaaaaceeeeiiiidnoooooouuuyybyRr +";
			$string = strtr($string, $a, $b);
			$string = str_replace(".", "", $string);
			$string = str_replace("º", "", $string);
			$string = str_replace("ª", "", $string);
			$string = str_replace("±", "", $string);
			$string = str_replace("%", "", $string);
			return $string;
		}
		public function formatarCodigo($codigo){
			$a = array(
				array("AT-", "AT"),
				array("AT", "AT-"),
				array("AT-C", "ATC-"),
				array("ATC-UB", "AT-CUB")
			);
			foreach($a as $b)
				$codigo = str_replace($b[0], $b[1], $codigo);
			return $codigo;
		}
		public function formatarPreco($preco, $exibirBRL = true){
			return ($exibirBRL ? "R$ " : "").number_format($preco, 2, ",", ".");
		}
		public function validarControlador($controlador){
			$arquivo = "controladores/$controlador.php";
			if(!is_file($arquivo)){
				echo"Acesso negado.";
				exit;
			}
			return $arquivo;
		}
		public function checarAjax($script){
			$isAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND
			strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
			if(!$isAjax){
				echo"Acesso negado.";
				exit;
			}
		}
		public function separarForm($array, $utf8_decode = false){
			$arrayReturn = array();
			if(!is_array($array))
				parse_str($array, $array);
			if(is_array($array)){
				foreach($array as $c => $v){
					if($utf8_decode)
						$v = utf8_decode($v);
					$arrayReturn[$c] = addslashes($v);
				}
			}
			return $arrayReturn;
		}
		public function carregarInsertSQL($tabela, $colunas, $valores){
			foreach($valores as $c => $v)
				$valores[$c] = "'".addslashes($v)."'";
			return "INSERT INTO `$tabela` (`".implode("`, `", $colunas)."`) VALUES (".implode(", ", $valores).");";
		}
		public function carregarSearchSQL($colunas, $valores){
			$searchSQL = array();
			foreach($valores as $c => $v)
				$searchSQL[] = "(`".(is_array($colunas) ? $colunas[$c] : $colunas)."` LIKE '".$valores[$c]."')";
			return "WHERE (".implode(" OR ", $searchSQL).")";
		}
		public function enviarEmail($destinatario, $assunto, $conteudo, $remetenteNome, $remetenteEmail){
			$cabecalho = "MIME-Version: 1.0\r\n";
			$cabecalho .= "Content-Type: text/html; charset=UTF-8\r\n";
			$cabecalho .= "From: ".(!empty($remetenteNome) ? $remetenteNome." - " : "")." ATEK FLASH SYSTEM <$remetenteEmail>\r\n";
			mail($destinatario, utf8_encode($assunto), utf8_encode($conteudo), $cabecalho);
		}
	}
?>