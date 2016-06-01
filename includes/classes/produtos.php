<?php
	class Produtos {
		public function pegarUrl($anuncio, $descricao = ""){
			$Anuncios = new Anuncios();
			return $Anuncios->pegarUrl($anuncio, array($descricao));
		}

		public function pegarDescricao($id){
			$informacoes = $this->pegarInformacoes($id);
			return (count($informacoes) > 0 ? $informacoes["descricao"] : "Não Encontrado");
		}

		public function pegarInformacoes($id){
			$informacoes = array();
			$Funcao = new Funcao();

			$queryProdutos = mysql_query("SELECT * FROM `produtos` ".$Funcao->carregarSearchSQL("id", is_array($id) ? $id : array($id)));
			while($resultadoProdutos = mysql_fetch_assoc($queryProdutos))
				$informacoes[$resultadoProdutos["id"]] = $resultadoProdutos;

			if(count($informacoes) > 0){
				$queryAnuncios = mysql_query("SELECT * FROM `anuncios_produtos` ".$Funcao->carregarSearchSQL("produto", array_keys($informacoes)));
				while($resultadoAnuncios = mysql_fetch_assoc($queryAnuncios)){
					$produtoId = $resultadoAnuncios["produto"];
					$descricao = ($informacoes[$produtoId]["descricao_site"] ? $informacoes[$produtoId]["descricao_site"] : $informacoes[$produtoId]["descricao"]);
					$informacoes[$produtoId]["link"] = $this->pegarUrl($resultadoAnuncios, array("descricao" => $descricao));
				}
			}

			return (count($informacoes) == 1 ? $informacoes[$id] : $informacoes);
		}
	}
?>