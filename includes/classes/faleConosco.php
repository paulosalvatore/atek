<?php
	class FaleConosco {
		private $formulario = array(
			"setor" => array(
				"exibicao" => "Setor",
				"tipo" => "lista",
				"opcoes" => array(
					"vendas" => "Vendas",
					"assistencia_tecnica" => "Assistência Técnica",
					"outros" => "Outros"
				),
				"obrigatorio" => true,
				"textoOpcoes" => "Selecione o setor desejado"
			),
			"nome" => array(
				"exibicao" => "Nome",
				"tipo" => "texto",
				"size" => 94,
				"minlength" => 3,
				"maxlength" => 255,
				"maxlengthInput" => 255,
				"tipoDados" => array(
					"numeros" => false,
					"letras" => true,
					"simbolos" => true,
				),
				"tipoDadosObrigatorio" => array(
					"numeros" => false,
					"letras" => false,
					"email" => false,
				),
				"obrigatorio" => true,
				"removerCaracteres" => "",
				"adicionais" => ""
			),
			"email" => array(
				"exibicao" => "E-mail",
				"tipo" => "texto",
				"size" => 94,
				"minlength" => 6,
				"maxlength" => 100,
				"maxlengthInput" => 100,
				"tipoDados" => array(
					"numeros" => true,
					"letras" => true,
					"simbolos" => true,
				),
				"tipoDadosObrigatorio" => array(
					"numeros" => false,
					"letras" => false,
					"email" => true,
				),
				"obrigatorio" => true,
				"removerCaracteres" => "",
				"adicionais" => ""
			),
			"assunto" => array(
				"exibicao" => "Assunto",
				"tipo" => "texto",
				"size" => 94,
				"minlength" => 3,
				"maxlength" => 78,
				"maxlengthInput" => 78,
				"tipoDados" => array(
					"numeros" => true,
					"letras" => true,
					"simbolos" => true,
				),
				"tipoDadosObrigatorio" => array(
					"numeros" => false,
					"letras" => false,
					"email" => false,
				),
				"obrigatorio" => false,
				"removerCaracteres" => "",
				"adicionais" => ""
			),
			"cep" => array(
				"exibicao" => "CEP",
				"tipo" => "texto",
				"size" => 18,
				"minlength" => 8,
				"maxlength" => 8,
				"maxlengthInput" => 9,
				"tipoDados" => array(
					"numeros" => true,
					"letras" => false,
					"simbolos" => false,
				),
				"tipoDadosObrigatorio" => array(
					"numeros" => true,
					"letras" => false,
					"email" => false,
				),
				"obrigatorio" => true,
				"removerCaracteres" => array("-", "_"),
				"adicionais" => '
					<img src="imagens/conteudo/pesquisar2.png" id="localizarCep" title="Localizar CEP">
					&nbsp;<a href="http://www.buscacep.correios.com.br/" target="_blank"><span class="peq">(não sabe seu CEP?)</span></a>
				'
			),
			"cidade" => array(
				"exibicao" => "Cidade",
				"tipo" => "texto",
				"size" => 94,
				"minlength" => 3,
				"maxlength" => 58,
				"tipoDados" => array(
					"numeros" => false,
					"letras" => true,
					"simbolos" => true,
				),
				"tipoDadosObrigatorio" => array(
					"numeros" => false,
					"letras" => true,
					"email" => false,
				),
				"obrigatorio" => false,
				"removerCaracteres" => "",
				"adicionais" => ""
			),
			"estado" => array(
				"exibicao" => "Estado",
				"tipo" => "texto",
				"size" => 94,
				"minlength" => 2,
				"maxlength" => 58,
				"maxlengthInput" => 58,
				"tipoDados" => array(
					"numeros" => false,
					"letras" => true,
					"simbolos" => true,
				),
				"tipoDadosObrigatorio" => array(
					"numeros" => false,
					"letras" => true,
					"email" => false,
				),
				"obrigatorio" => false,
				"removerCaracteres" => "",
				"adicionais" => ""
			),
			"telefone" => array(
				"exibicao" => "Telefone",
				"tipo" => "texto",
				"size" => 94,
				"minlength" => 10,
				"maxlength" => 11,
				"maxlengthInput" => 11,
				"tipoDados" => array(
					"numeros" => true,
					"letras" => false,
					"simbolos" => false,
				),
				"tipoDadosObrigatorio" => array(
					"numeros" => true,
					"letras" => false,
					"email" => false,
				),
				"obrigatorio" => false,
				"removerCaracteres" => array("(", ")", "-", " ", "_"),
				"adicionais" => ""
			),
			"mensagem" => array(
				"exibicao" => "Mensagem",
				"tipo" => "texto",
				"size" => 0,
				"minlength" => 3,
				"maxlength" => 1000,
				"maxlengthInput" => 1000,
				"tipoDados" => array(
					"numeros" => true,
					"letras" => true,
					"simbolos" => true,
				),
				"tipoDadosObrigatorio" => array(
					"numeros" => false,
					"letras" => false,
					"email" => false,
				),
				"obrigatorio" => true,
				"removerCaracteres" => "",
				"adicionais" => ""
			),
			"orcamento" => ""
		);
		public function exibirFormulario(){
			$exibirFormulario = '
				<div id="conteudoFaleConosco">
					Use o espaço abaixo para enviar suas dúvidas, sugestões ou para enviar
					orçamentos feitos pelo site.<br>
					Caso prefira, envie um e-mail para: <a href="mailto:atek@atek.com.br">atek@atek.com.br</a>.
					<form id="faleConosco">
						<table width="646" cellpadding="5" cellspacing="0">
							';
							foreach($this->formulario as $c => $v){
								if(is_array($v)){
									$exibirCampo = $v["exibicao"];
									$tipoCampo = $v["tipo"];
									$obrigatorio = $v["obrigatorio"];
									if($obrigatorio)
										$exibirCampo = "*".$exibirCampo;
									if($tipoCampo == "texto"){
										$variaveis = array();
										$size = $v["size"];
										$maxlengthInput = $v["maxlengthInput"];
										$adicionais = $v["adicionais"];
										$variaveis[] = 'name="'.$c.'"';
										$variaveis[] = 'id="'.$c.'"';
										$variaveis[] = 'class="input"';
										if($c !== "mensagem")
											$variaveis[] = 'type="text"';
										if($size > 0)
											$variaveis[] = 'size="'.$size.'"';
										if($maxlengthInput > 0)
											$variaveis[] = 'maxlength="'.$maxlengthInput.'"';
										$variaveis = implode(" ", $variaveis);
										if(strpos($c, "mensagem") !== false)
											$input = '<textarea '.$variaveis.'></textarea>';
										else
											$input = '<input '.$variaveis.'>';
										$adicionais .= '<div class="imagem certo_errado errado"></div>';
									}
									elseif($tipoCampo == "lista"){
										$size = $v["size"];
										$opcoes = $v["opcoes"];
										$textoOpcoes = $v["textoOpcoes"];
										$adicionais = $v["adicionais"];
										$variaveis[] = 'name="'.$c.'"';
										$variaveis[] = 'id="'.$c.'"';
										$variaveis[] = 'class="input"';
										$variaveis = implode(" ", $variaveis);
										$exibirOpcoes = '<option value="">'.$textoOpcoes.'</option>';
										foreach($opcoes as $opcaoId => $opcaoNome)
											$exibirOpcoes .= '<option value="'.$opcaoId.'">'.$opcaoNome.'</option>';
										$input = '<select '.$variaveis.'>'.$exibirOpcoes.'</select>';
									}
									else
										$input = "";
									$exibirFormulario .= '
										<tr valign="top">
											<td width="120" align="right" class="exibicaoBloco">
												<label for="'.$c.'"><b>'.$exibirCampo.':</b></label>
											</td>
											<td align="left">
												'.$input.'
												'.$adicionais.'
												<div class="mensagemErro"></div>
											</td>
										</tr>
									';
								}
							}
							$exibirFormulario .= '
							<tr valign="top" id="enviarOrcamentoDisponivel">
								<td align="right">
									<input type="checkbox" id="enviarOrcamento" name="orcamento" value="'.$orca_id.'">
								</td>
								<td>
									<label for="enviarOrcamento">
										<b>Anexar orçamento feito pelo site.</b>
									</label><br>
									<span class="textoPequeno link" onClick="carregarOrcamento(\'maximizar\');">
										(Clique aqui para visualizar seu orçamento)
									</span>
								</td>
							</tr>
							<tr valign="top" id="enviarOrcamentoIndisponivel">
								<td>
								</td>
								<td>
									<span class="textoDestaque">
										Você pode anexar orçamentos feitos pelo site.<br>
										Para criá-los você deverá ir até a página do produto desejado e clicar no botão "Incluir no Orçamento".<br>
									</span>
								</td>
							</tr>
							<tr valign="top">
								<td>
								</td>
								<td>
									<input type="submit" value="Enviar">
									<input type="reset" class="button" value="Limpar Campos">
								</td>
							</tr>
						</table>
					</form>
					<span class="textoPequeno">*Campos obrigatórios</span><br>
				</div>
			';
			return $exibirFormulario;
		}
	}
?>