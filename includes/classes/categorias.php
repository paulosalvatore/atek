<?php
	class Categorias {
		public function pegarUrl($id, $descricao = ""){
			$Funcao = new Funcao();
			return "?p=categorias-$id-".$Funcao->limparString(($descricao ? $descricao : $this->pegarDescricao($id)));
		}
		public function pegarDescricao($id){
			$informacoes = $this->pegarInformacoes($id);
			return (count($informacoes) > 0 ? $informacoes["descricao"] : "Não Encontrado");
		}
		public function pegarInformacoes($id){
			$informacoes = array();
			$Funcao = new Funcao();
			$queryCategoria = mysql_query("SELECT * FROM `categorias` ".$Funcao->carregarSearchSQL("id", is_array($id) ? $id : array($id)));
			while($resultadoCategoria = mysql_fetch_assoc($queryCategoria)){
				$categoriaId = $resultadoCategoria["id"];
				$informacoes[$categoriaId] = $resultadoCategoria;
				$informacoes[$categoriaId]["link"] = $this->pegarUrl($categoriaId, $resultadoCategoria["descricao"]);
			}
			return (count($informacoes) == 1 ? $informacoes[$id] : $informacoes);
		}
		public function carregarBarraNavegacao($categoriaInfo){
			$Menus = new Menus();
			$menu = $Menus->pegarInformacoes($categoriaInfo["menu"]);
			return array($menu["descricao"] => $menu["link"]);
		}
	}
?>