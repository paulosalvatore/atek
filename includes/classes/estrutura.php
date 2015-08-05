<?php
	class Estrutura {
		private $menuPrincipal = array(
			"principal" => "Home",
			"dicas" => "Dicas",
			"como_comprar" => "Como Comprar",
			"assistencia_tecnica" => "Assistência Técnica",
			"localizacao" => "Localização",
			"fale_conosco" => "Fale Conosco"
		);
		public function exibirMenuPrincipal(){
			$menuPrincipal = '
				<table border="0" cellpadding="0" cellspacing="0">
					<tr>
						';
						foreach($this->menuPrincipal as $link => $exibicao)
							$menuPrincipal .= '
								<td>
									<a href="?p='.$link.'">'.$exibicao.'</a>
								</td>
								'.(
								$c++ < count($this->menuPrincipal)-1 ? '
								<td>
									<img src="imagens/menuPrincipal/div.gif" alt="" />
								</td>
								' : "").'
							';
						$menuPrincipal .= '
					</tr>
				</table>
			';
			return $menuPrincipal;
		}
		public function exibirCabecalho(){
			$imagemCabecalho = 4;
			return '
				<div id="cabecalho" style="background: url(imagens/cabecalho/'.$imagemCabecalho.'-fundo.png);">
					<img src="imagens/cabecalho/'.$imagemCabecalho.'-cabecalho.png" alt="Cabeçalho Página" />
				</div>
			';
		}
		public function exibirMenuEsquerdo(){
			$Menus = new Menus();
			$Categorias = new Categorias();
			$menuEsquerdo = array();
			$queryMenuEsquerdo = mysql_query("SELECT * FROM menu_esquerdo ORDER BY ordem ASC");
			while($resultadoMenuEsquerdo = mysql_fetch_assoc($queryMenuEsquerdo))
				$menuEsquerdo[] = $resultadoMenuEsquerdo;
			$alturaMenuEsquerdo = count($menuEsquerdo)*23+6;
			$exibirMenuEsquerdo = '
				<ul class="menuEsquerdo">
					<div id="bordaLateral" style="height: '.$alturaMenuEsquerdo.'px;">
						<img src="imagens/menuEsquerdo/bordaLateral.gif" width="6" height="'.$alturaMenuEsquerdo.'" alt="" />
					</div>
					';
					foreach($menuEsquerdo as $informacoesBotao){
						if($informacoesBotao["pagina"] == "menus")
							$url = $Menus->pegarUrl($informacoesBotao["link_id"]);
						elseif($informacoesBotao["pagina"] == "categorias")
							$url = $Categorias->pegarUrl($informacoesBotao["link_id"]);
						else
							$url = "?p=".$informacoesBotao["pagina"];
						$exibirMenuEsquerdo .= '
							<li class="fundo'.$informacoesBotao["fundo"].'">
								<div class="handle">
									<a href="'.$url.'">
										'.$informacoesBotao["nome"].'
									</a>
								</div>
							</li>
						';
					}
					$exibirMenuEsquerdo .= '
					<li>
						<div id="bordaFinal">
							<img src="imagens/menuEsquerdo/barraFinal.gif" width="142" height="6" alt="" />
						</div>
					</li>
				</ul>
			';
			return $exibirMenuEsquerdo;
		}
		public function exibirRodape(){
			$rodape = '
				<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top: 50px;">
					<tr>
						<td background="imagens/rodape/fundo1.gif">
							<img src="imagens/rodape/fundo1.gif" alt="" />
						</td>
					</tr>
				</table>
				<div id="rodape" align="center">
					'.$this->exibirMenuPrincipal().'
				</div>
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td background="imagens/rodape/fundo2.gif">
							<table width="100%" border="0" cellspacing="10" cellpadding="0" align="middle" height="56">
								<tr>
									<td width="45%" align="right">
										<a href="?p=principal"><img src="imagens/rodape/logo.jpg" border="0" alt="" /></a>
									</td>
									<td width="55%" align="left" class="textoRodape">
										© Todos os Direitos Reservados - Fone: (11) 3272-0366
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			';
			return $rodape;
		}
	}
?>