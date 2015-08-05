<?php
	class Categorias {
		public function pegarUrl($id){
			return "?p=categorias-$id-".$this->pegarDescricao($id, true);
		}
		public function pegarDescricao($id, $limparAcentuacao){
			$informacoes = $this->pegarInformacoes($id);
			$Funcao = new Funcao();
			return (count($informacoes) > 0 ? $Funcao->limparString($informacoes["descricao"]) : "Não Encontrado");
		}
		public function pegarInformacoes($id){
			$informacoes = array();
			$queryMenu = mysql_query("SELECT * FROM categorias WHERE (id LIKE '$id')");
			while($resultadoMenu = mysql_fetch_assoc($queryMenu))
				$informacoes = $resultadoMenu;
			return $informacoes;
		}
	}
?>