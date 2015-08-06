<?php
	class Produtos {
		public function pegarUrl($id){
			return "?p=produtos-$id-".$this->pegarDescricao($id, true);
		}
		public function pegarDescricao($id, $limparAcentuacao){
			$informacoes = $this->pegarInformacoes($id);
			$Funcao = new Funcao();
			return (count($informacoes) > 0 ? $Funcao->limparString($informacoes["descricao_site"]) : "Não Encontrado");
		}
		public function pegarInformacoes($id){
			$informacoes = array();
			$queryProduto = mysql_query("SELECT * FROM produtos WHERE (id LIKE '$id')");
			while($resultadoProduto = mysql_fetch_assoc($queryProduto))
				$informacoes = $resultadoProduto;
			return $informacoes;
		}
	}
?>