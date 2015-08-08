<?php
	class Anuncios {
		private $diretorioImagensAnuncios = "imagens/anuncios/";
		private $diretorioImagensCategorias = "imagens/categorias/";
		private $ocultarDisponibilidade = true;
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
			$Funcao = new Funcao();
			$anuncios = $this->carregar($id, $area);
			$anunciosMap = array_map("array_values", $anuncios);
			$anuncios[0] = $anunciosMap[0];
			$qtdeAnuncios = count($anuncios[0]);
			$anunciosPorLinha = 3;
			$maxProdutosAnuncio = 4;
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
				<table class="anuncios">
					';
					$linha = 0;
					for($i=0;$i<$qtdeAnuncios*3;$i++){
						if($i == 0 OR ($i)%$anunciosPorLinha == 0){
							$linha = ($i > 0 ? $linha + 1 : $linha);
							$linhaAtual = floor($linha/3);
							$exibirAnuncios .= ($i > 0 ? "</tr>" : "").(($linha - $linhaAtual - 2 * $linhaAtual == 0 AND $i < $qtdeAnuncios * 3) ? '<tr><td colspan="3" style="height: 25px;"></td></tr>' : "").($i < $qtdeAnuncios * 3 ? '<tr align="center">' : "");
						}
						$anuncio = $anuncios[0][$i - $linha * 3 + $linhaAtual * 3];
						if(!is_array($anuncio))
							continue;
						$anuncioInfo = $anuncio["info"];
						$exibirLink = false;
						$exibirAnuncio = "";
						switch($linha - $linhaAtual - 2 * $linhaAtual){
							case 0:
								$banner = ($anuncioInfo["oferta"] == 1 ? "oferta" : ($anuncioInfo["lancamento"] == 1 ? "lancamento" : ""));
								$exibirAnuncio = ($banner ? '<img src="imagens/banners/'.$banner.'.gif" />' : "");
								break;
							case 1:
								$exibirLink = true;
								$exibirAnuncio = '<img src="'.$this->pegarImagem($anuncio["tipo"], $anuncio["anuncio"], "p").'" />';
								break;
							case 2:
								$exibirLink = true;
								if($anuncio["tipo"] == 1){
									$produtosInfo = $anuncios[1];
									$produtos = array_slice($anuncio["produtos"], 0, $maxProdutosAnuncio);
									$codigos = array();
									if($anuncioInfo["exibir_codigo"] == 1){
										if($anuncioInfo["exibir_codigo_geral"] == 1)
											$codigos[] = $anuncioInfo["codigo"];
										else{
											foreach($produtos as $produtoId)
												$codigos[] = $Funcao->formatarCodigo($produtosInfo[$produtoId]["codigo"]);
										}
										$exibirAnuncio .= implode(" | ", $codigos).'<br>';
									}
									if($anuncioInfo["exibir_descricao"] == 1)
										$exibirAnuncio .= ($anuncioInfo["descricao"] ? $anuncioInfo["descricao"] : $produtosInfo[$produtos[0]["descricao_site"]]).'<br>';
									if($anuncioInfo["exibir_publicidade"] == 1)
										$exibirAnuncio .= '<span class="'.$anuncioInfo["span_publicidade"].'">'.$anuncioInfo["publicidade"].'</span><br>';
									if($anuncioInfo["exibir_preco"] == 1){
										if($anuncioInfo["exibir_preco_geral"] == 1)
											$preco = $anuncioInfo["preco"];
										else{
											$precos = array();
											foreach($produtos as $c => $produtoId)
												$precos[] = array(
													"preco" => $Funcao->formatarPreco($produtosInfo[$produtoId]["preco"]),
													"precoAntigo" => $Funcao->formatarPreco($produtosInfo[$produtoId]["preco_antigo"]),
													"exibirPrecoAntigo" => $produtosInfo[$produtoId]["exibir_preco_antigo"],
													"disponibilidade" => $produtosInfo[$produtoId]["disponibilidade"]
												);
											$preco = $this->exibirPreco($precos);
										}
										$exibirAnuncio .= $preco.'<br>';
									}
								}
								else{
									
								}
								break;
						}
						$exibirAnuncios .= '
							<td class="caixaAnuncio">
								'.($exibirLink ? '<a href="#">'.$exibirAnuncio.'</a>' : $exibirAnuncio).'
							</td>
						';
					}
					$exibirAnuncios .= '
				</table>
			';
			return $exibirAnuncios;
		}
		public function pegarImagem($tipo, $id, $imagem){
			$diretorio = ($tipo == 1 ? $this->diretorioImagensAnuncios : $this->diretorioImagensCategorias);
			$arquivo = $diretorio.$id.$imagem;
			$arquivoJpg = $arquivo.".jpg";
			$arquivoGif = $arquivo.".gif";
			$arquivoPng = $arquivo.".png";
			if(strpos($imagem, "g") === false){
				if(is_file($arquivoJpg))
					return $arquivoJpg;
				elseif(is_file($arquivoGif))
					return $arquivoGif;
				elseif(is_file($arquivoPng))
					return $arquivoPng;
			}
			else{
				return "b";
				// Imagens Grandes
			}
			return "imagens/conteudo/semImagem".($imagem == "pp" ? "100" : "200").".jpg";
		}
		public function exibirPreco($precos){
			if(count($produtos) == 1)
				$produtoIndisponivel = "Produto indisponível";
			else
				$produtoIndisponivel = "Indisponível";
			$exibicaoPreco = '<table>';
			$linhaPreco = 0;
			$novaLinhaPreco = 1;
			while($novaLinhaPreco > 0){
				$linhaPreco++;
				$exibicaoPreco .= '<tr>';
				foreach($precos as $c => $precoInfo){
					if($chave == 0)
						$novaLinhaPreco = 0;
					if($chave > 0)
						$valorAnterior = $valor;
					$exibirDivisoria = 0;
					$exibirCelulaVazia = 0;
					$exibirDePor = 0;
					$preco = $precoInfo["preco"];
					$precoAntigo = $precoInfo["precoAntigo"];
					$exibirPrecoAntigo = $precoInfo["exibirPrecoAntigo"];
					$disponibilidade = $precoInfo["disponibilidade"];
					$exibirPrecoAntigoAnterior = $precos[$c-1]["exibirPrecoAntigo"];
					$divisoria = "";
					$dePor = "";
					if($this->ocultarDisponibilidade OR $disponibilidade == 1){
						$formatacao = 'preco_categoria';
						if($exibirPrecoAntigo == 1){
							if($exibirPrecoAntigoAnterior == 1)
								$exibirDePor = 0;
							else
								$exibirDePor = 1;
						}
						if($exibirDePor == 1)
							$novaLinhaPreco = 1;
						if($exibirPrecoAntigo == 1){
							if($linhaPreco == 1){
								$valor = $precoAntigo;
								$formatacao = 'preco_antigo_categoria';
							}
							else
								$valor = $preco;
						}
						else{
							if($linhaPreco == 1)
								$valor = $preco;
							else
								$valor = "";
						}
					}
					else{
						$formatacao = 'preco_antigo_categoria';
						if($linhaPreco == 1)
							$valor = $produtoIndisponivel;
						else
							$valor = "";
					}
					if($chave > 0){
						if($linhaPreco == 1)
							$exibirDivisoria = 1;
						elseif($linhaPreco == 2){
							if((empty($valorAnterior)) AND (empty($valor)))
								$exibirCelulaVazia = 1;
							else
								$exibirDivisoria = 1;
						}
					}
					if($exibirDivisoria == 1)
						$divisoria = '<td class="preco_categoria" style="cursor: pointer;">|</td>';
					if($exibirCelulaVazia == 1)
						$divisoria = '<td class="preco_categoria" style="cursor: pointer;"></td>';
					if($exibirDePor == 1){
						if($linhaPreco == 1)
							$dePor = '<td class="preco_categoria" style="cursor: pointer;">De:</td>';
						elseif($linhaPreco == 2)
							$dePor = '<td class="preco_categoria" style="cursor: pointer;">Por:</td>';
					}
					$celulaValor = '<td class="'.$formatacao.'" style="cursor: pointer;">'.$valor.'</td>';
					$exibicaoPreco .= $divisoria.$dePor.$celulaValor;
				}
				$exibicaoPreco .= '</tr>';
				if($linhaPreco == 2)
					$novaLinhaPreco = 0;
			}
			$exibicaoPreco .= '</table>';
			return $exibicaoPreco;
		}
	}
?>