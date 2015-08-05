<?php
	class Menus {
		public function pegarUrl($id){
			return "?p=menus-$id-".$this->pegarDescricao($id);
		}
		public function pegarDescricao($id){
			$informacoes = $this->pegarInformacoes($id);
			$Funcao = new Funcao();
			return (count($informacoes) > 0 ? $Funcao->limparString($informacoes["descricao"]) : "Não Encontrado");
		}
		public function pegarInformacoes($id){
			$informacoes = array();
			$queryMenu = mysql_query("SELECT * FROM menus WHERE (id LIKE '$id')");
			while($resultadoMenu = mysql_fetch_assoc($queryMenu))
				$informacoes = $resultadoMenu;
			return $informacoes;
		}
	}
?>