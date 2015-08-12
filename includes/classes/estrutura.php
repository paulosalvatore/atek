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
		private $diretorioPaginas = "paginas/";
		private $arquivoNaoEncontrado = "naoEncontrado";
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
		public function exibirAviso(){
			$queryConfig = mysql_query("SELECT * FROM config");
			while($resultadoConfig = mysql_fetch_assoc($queryConfig)){
				$aviso = $resultadoConfig["aviso"];
				$corAviso = $resultadoConfig["cor_aviso"];
			}
			return ($aviso ? '<span style="color: #'.$corAviso.';">'.$aviso.'</span>' : "");
		}
		public function pegarLinkSubmenu($pagina, $linkId){
			if($pagina == "menus")
				$Classe = new Menus();
			elseif($pagina == "categorias")
				$Classe = new Categorias();
			elseif($pagina == "produtos")
				$Classe = new Produtos();
			return ($Classe ? $Classe->pegarUrl($linkId) : "?p=".$pagina."-".$linkId);
		}
		public function exibirSubmenu($id){
			$exibirSubmenu = "";
			$submenu = array();
			$larguraTotal = 0;
			$querySubmenu = mysql_query("SELECT * FROM submenus WHERE submenu LIKE '$id' ORDER BY ordem ASC");
			while($resultadoSubmenu = mysql_fetch_assoc($querySubmenu)){
				$submenu[] = $resultadoSubmenu;
				$larguraTotal += $resultadoSubmenu["largura"];
			}
			$exibirSubmenu .= '
				<div id="submenu">
					<ul id="listaSubmenu">
						';
						foreach($submenu as $c => $v)
							$exibirSubmenu .= '
								<li style="width: '.number_format(($larguraTotal != 100 ? 100/count($submenu) : $v["largura"]), 12, ".", "").'%;">
									<div>
										<a href="'.($this->pegarLinkSubmenu($v["pagina"], $v["link_id"])).'">
											'.$v["nome"].'
										</a>
									</div>
								</li>
							';
						$exibirSubmenu .= '
					</ul>
					<div id="sombra"></div>
				</div>
			';
			return $exibirSubmenu;
		}
		public function exibirPagina($pagina){
			$arquivo = $this->diretorioPaginas.(is_file($this->diretorioPaginas.$pagina.".php") ? $pagina : $this->arquivoNaoEncontrado).".php";
			include("includes/incluirArquivos.php");
			include("includes/iniciarClasses.php");
			include($arquivo);
			$conteudoPagina = "";
			if($submenu > 0)
				$conteudoPagina .= $this->exibirSubmenu($submenu);
			$ordemTituloBarra = ($ordemTituloBarra == 2 ? array(2, 4) : array(0, 2));
			for($i = $ordemTituloBarra[0];$i < $ordemTituloBarra[1];$i++){
				if($i == 0 OR $i == 3){
					if(!empty($titulo) AND $ocultarTitulo != 1)
						$conteudoPagina .= '
							<div class="titulo">
								'.$titulo.'
							</div>
						';
				}
				elseif($i == 1 OR $i == 2){
					if($ocultarBarraNavegacao != 1){
						$barraNavegacaoInicial = array("Home" => "?p=principal");
						if(is_array($barraNavegacao))
							$barraNavegacao = array_merge($barraNavegacaoInicial, $barraNavegacao);
						else
							$barraNavegacao = $barraNavegacaoInicial;
						$conteudoPagina .= '
							<div class="barraNavegacao">
								';
								foreach($barraNavegacao as $nome => $link)
									$conteudoPagina .= '
										<a href="'.$link.'">'.$nome.'</a> >
									';
								$conteudoPagina .= '
								'.$titulo.'
							</div>
						';
					}
				}
			}
			if(!empty($conteudo))
				$conteudoPagina .= '
					<div class="conteudoPagina"'.($corConteudo ? ' style="background-color: '.$corConteudo.';"' : "").'>
						'.$conteudo.'
					</div>
				';
			if(!empty($incluirConteudo))
				$conteudoPagina .= $incluirConteudo;
			return $conteudoPagina;
		}
	}
?>