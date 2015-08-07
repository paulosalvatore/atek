<?php
	class Anuncios {
		private $diretorioImagensAnuncios = "imagens/anuncios/";
		private $diretorioImagensCategorias = "imagens/categorias/";
		public function carregar($id, $area){
			$anuncioId = "anuncio";
			if($area == "categorias"){
				$tabela = "categorias_anuncios";
				$verificarCampo = "categoria";
			}
			elseif($area == "relacionados"){
				$tabela = "anuncios_relacionados";
				$verificarCampo = "anuncio";
				$anuncioId = "relacionado";
			}
			elseif($id == "pagina_principal")
				$tabela = "pagina_principal";
			$anuncios = array();
			$anunciosTipos = array();
			$queryAnuncios = mysql_query("SELECT * FROM `$tabela` ".($verificarCampo ? "WHERE (`$verificarCampo` LIKE '$id')" : "")." ORDER BY `ordem` ASC");
			while($resultadoAnuncios = mysql_fetch_assoc($queryAnuncios)){
				$anuncios[$resultadoAnuncios[$anuncioId]] = $resultadoAnuncios;
				$anunciosTipos[$resultadoAnuncios["tipo"]][] = $resultadoAnuncios[$anuncioId];
			}
			$Funcao = new Funcao();
			$tipoProdutos = 1;
			$tipoCategorias = 2;
			$anunciosProdutos = ($anunciosTipos[$tipoProdutos] ? $anunciosTipos[$tipoProdutos] : array());
			$anunciosCategorias = ($anunciosTipos[$tipoCategorias] ? $anunciosTipos[$tipoCategorias] : array());
			$produtos = array();
			$categorias = array();
			if(count($anunciosProdutos) > 0){
				$queryAnuncios = mysql_query("SELECT * FROM `anuncios` ".$Funcao->carregarSearchSQL("id", $anunciosProdutos));
				while($resultadoAnuncios = mysql_fetch_assoc($queryAnuncios))
					$anuncios[$resultadoAnuncios["id"]]["info"] = $resultadoAnuncios;
				$queryAnunciosProdutos = mysql_query("SELECT * FROM `anuncios_produtos` ".$Funcao->carregarSearchSQL("anuncio", $anunciosProdutos)." ORDER BY ordem ASC");
				while($resultadoAnunciosProdutos = mysql_fetch_assoc($queryAnunciosProdutos)){
					$produtoId = $resultadoAnunciosProdutos["produto"];
					$anuncios[$resultadoAnunciosProdutos["anuncio"]]["produtos"][] = $produtoId;
					if(!array_key_exists($produtoId, $produtos))
						$produtos[$produtoId] = array();
				}
				$Produtos = new Produtos();
				$produtos = $Produtos->pegarInformacoes(array_keys($produtos));
			}
			if(count($anunciosCategorias) > 0){
				$Categorias = new Categorias();
				$categorias = $Categorias->pegarInformacoes($anunciosCategorias);
			}
			return array($anuncios, $produtos, $categorias);
		}
		public function exibir($id, $area = ""){
			$anuncios = $this->carregar($id, $area);
			$qtdeAnuncios = 9;
			$anunciosPorLinha = 3;
			$exibirAnuncios = "";
			$exibirAnuncios .= '
				<style>
					.anuncios {
						display: table;
						width: 100%;
					}
					.caixaAnuncio {
						width: 33.3333%;
						min-height: 200px;
						display: table-cell;
					}
					.tableRow {
						display: table-row;
					}
				</style>
			<div class="anuncios">
			';
			$linha = 0;
			for($i=0;$i<$qtdeAnuncios*3;$i++){
				if($i == 0 OR ($i)%$anunciosPorLinha == 0){
					$exibirAnuncios .= ($i > 0 ? "</div>" : "").'<div class="tableRow">';
					$linha = ($i > 0 ? $linha + 1 : $linha);
				}
				$linhaAtual = floor($linha/3);
				$anuncio = $i - $linha * 3 + $linhaAtual * 3;
				switch($linha - $linhaAtual - 2 * $linhaAtual){
					case 0:
						$exibir = "banner";
						break;
					case 1:
						$exibir = "imagem";
						break;
					case 2:
						$exibir = "detalhes";
						break;
				}
				$exibirAnuncios .= '
					<div class="caixaAnuncio">
						'.$anuncio.' - '.$exibir.'
					</div>
				';
			}
			$exibirAnuncios .= '
				</div>
			';
			return $exibirAnuncios;
		}
		public function pegarImagem($tipo, $id, $imagem){
			$diretorio = ($tipo == "anuncios" ? $this->diretorioImagensAnuncios : $this->diretorioImagensCategorias);
			$arquivo = $diretorio.$id.$imagem;
			$arquivoJpg = $arquivo.".jpg";
			$arquivoGif = $arquivo.".gif";
			$arquivoPng = $arquivo.".png";
			if(strpos($imagem, "g" === false)){
				if(is_file($arquivoJpg))
					return $arquivoJpg;
				elseif(is_file($arquivoGif))
					return $arquivoGif;
				elseif(is_file($arquivoPng))
					return $arquivoPng;
			}
			else{
				// Imagens Grandes
			}
			return "imagens/conteudo/semImagem".($imagem == "pp" ? "100" : "200").".jpg";
		}
	}
?>