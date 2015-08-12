<?php
	class Menus {
		public function pegarUrl($id, $descricao = ""){
			$Funcao = new Funcao();
			return "?p=menus-$id-".$Funcao->limparString(($descricao ? $descricao : $this->pegarDescricao($id)));
		}
		public function pegarDescricao($id){
			$informacoes = $this->pegarInformacoes($id);
			return (count($informacoes) > 0 ? $informacoes["descricao"] : "Não Encontrado");
		}
		public function pegarInformacoes($id){
			$informacoes = array();
			$Funcao = new Funcao();
			$queryMenu = mysql_query("SELECT * FROM `menus` ".$Funcao->carregarSearchSQL("id", is_array($id) ? $id : array($id)));
			while($resultadoMenu = mysql_fetch_assoc($queryMenu)){
				$menuId = $resultadoMenu["id"];
				$informacoes[$menuId] = $resultadoMenu;
				$informacoes[$menuId]["link"] = $this->pegarUrl($menuId, $resultadoMenu["descricao"]);
			}
			return (count($informacoes) == 1 ? $informacoes[$id] : $informacoes);
		}
		public function exibir($id){
			$exibirMenu = "";
			$submenu = array();
			$larguraTotal = 0;
			$querySubmenu = mysql_query("SELECT * FROM submenus WHERE submenu LIKE '$id' ORDER BY ordem ASC");
			while($resultadoSubmenu = mysql_fetch_assoc($querySubmenu)){
				$submenu[] = $resultadoSubmenu;
				$larguraTotal += $resultadoSubmenu["largura"];
			}
			$Estrutura = new Estrutura();
			$Anuncios = new Anuncios();
			$exibirMenu .= '
				<table width="100%">
					<tr align="center">
						';
						foreach($submenu as $c => $v){
							switch($v["pagina"]){
								case "menus":
									$tipoImagem = 3;
									break;
								case "categorias":
									$tipoImagem = 2;
									break;
								case "produtos":
									$tipoImagem = 1;
									break;
							}
							$exibirMenu .= '
								<td style="width: '.number_format(($larguraTotal != 100 ? 100/count($submenu) : $v["largura"]), 12, ".", "").'%;">
									<a href="'.($Estrutura->pegarLinkSubmenu($v["pagina"], $v["link_id"])).'">
										<img src="'.$Anuncios->pegarImagem($tipoImagem, $v["link_id"], "m").'" border="0" title="'.$v["nome"].'">
									</a>
								</td>
							';
						}
						$exibirMenu .= '
					</tr>
				</table>
			';
			return $exibirMenu;
		}
	}
?>