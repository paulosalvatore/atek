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
			$Funcao = new Funcao();
			$queryProdutos = mysql_query("SELECT * FROM `produtos` ".$Funcao->carregarSearchSQL("id", is_array($id) ? $id : array($id)));
			while($resultadoProdutos = mysql_fetch_assoc($queryProdutos))
				$informacoes[$resultadoProdutos["id"]] = $resultadoProdutos;
			return (count($informacoes) == 1 ? $informacoes[$id] : $informacoes);
		}
	}
?>