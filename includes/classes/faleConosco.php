<?php
	class FaleConosco {
		public $formulario = array(
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
		public function enviarEmail($formulario){
			include("includes/arquivos/data.php");
			$Funcao = new Funcao();
			if(!empty($formulario["telefone"])){
				$ddd = substr($formulario["telefone"], 0, 2);
				if(strlen($formulario["telefone"]) == 10)
					$wr = 4;
				elseif(strlen($formulario["telefone"]) == 11)
					$wr = 5;
				$telefone = wordwrap(substr($formulario["telefone"], 2, 9), $wr, "-", true);
				$exibirTelefone = "(".$ddd.") ".$telefone;
			}
			$conteudoEmail = '
				<style>
					.conteudoEmail {
						font-family: Verdana;
						font-size: 14px;
						width: 980px;
					}
					.mensagem {
						word-wrap: break-word;
					}
					.conteudo_mensagem {
						width: 100%;
						font-size: 14px;
						table-layout: fixed;
					}
					.conteudo_mensagem, .conteudo_mensagem td {
						border: 1px solid black;
						border-collapse: collapse;
					}
					.orcamento {
						width: 100%;
						border: 1px solid #555555;
						text-align: center;
					}
					.cabecalho_orcamento {
						height: 40px;
						background: url(http://www.atek.com.br/imagens/geral/fundo_orcamento.png) no-repeat;
						background-repeat: repeat-x;
						font-size: 14px;
						font-weight: bold;
						color: #FFFFFF;
					}
					.produto_orcamento {
						color: #666666;
						font-weight: normal;
					}
					.produto_orcamento td {
						padding: 10px;
						border-bottom: 1px solid #E4E3E3;
						font-size: 12px;
					}
					.produto_orcamento .quantidade,
					.produto_orcamento .preco,
					.produto_orcamento .subtotal {
						border-left: 1px solid #E4E3E3;
					}
					.valores_orcamento {
						text-align: right;
					}
					.valores_orcamento td {
						padding: 5px;
						font-size: 13px;
						font-weight: bold;
						color: #666666;
					}
				</style>
				<div class="conteudoEmail">
					<img src="http://www.atek.com.br/gerenciamento/imagens/geral/logo_pedido.jpg"><br>
					<br>
					<table class="conteudo_mensagem" cellpadding="5" cellspacing="0" border="0">
						<tr>
							<td width="150">
								<b>Nome:</b>
							</td>
							<td>
								'.$formulario["nome"].'
							</td>
						</tr>
						<tr>
							<td width="150">
								<b>E-mail:</b>
							</td>
							<td>
								<a href="mailto:'.$formulario["email"].'">'.$formulario["email"].'</a>
							</td>
						</tr>
						';
						if(!empty($formulario["telefone"]))
							$conteudoEmail .= '
								<tr>
									<td width="150">
										<b>Telefone:</b>
									</td>
									<td>
										'.$exibirTelefone.'
									</td>
								</tr>
							';
						$conteudoEmail .= '
						<tr>
							<td width="150">
								<b>CEP:</b>
							</td>
							<td>
								'.wordwrap($formulario["cep"], 5, "-", true).'
							</td>
						</tr>
						';
						if((!empty($formulario["cidade"])) AND (!empty($formulario["estado"])))
							$conteudoEmail .= '
								<tr>
									<td width="150">
										<b>Cidade/Estado:</b>
									</td>
									<td>
										'.$formulario["cidade"].'/'.$formulario["estado"].'
									</td>
								</tr>
							';
						if(!empty($formulario["assunto"]))
							$conteudoEmail .= '
								<tr>
									<td width="150">
										<b>Assunto:</b>
									</td>
									<td>
										'.$formulario["assunto"].'
									</td>
								</tr>
							';
						$conteudoEmail .= '
						<tr>
							<td colspan="2">
								<b>Mensagem:</b><br>
								<div class="mensagem">
									'.$formulario["mensagem"].'
								</div>
							</td>
						</tr>
					</table>
					Mensagem enviada em <b>'.$data.' às '.$horario.'</b>.
				</div>
			';
			$destinoGeral = "contato@atek.com.br";
			if(($formulario["setor"] == "vendas") OR ($formulario["setor"] == "outros"))
				$destino = "atek@atek.com.br";
			if($formulario["setor"] == "assistencia_tecnica")
				$destino = "assistenciatecnica@atek.com.br";
			$assunto = $formulario["assunto"];
			if(empty($assunto))
				$assunto = "Sem assunto";
			$assuntoCliente = "Sua mensagem foi recebida";
			$conteudoEmailCliente = '
				<img src="http://www.atek.com.br/gerenciamento/imagens/geral/logo_pedido.jpg"><br>
				<br>
				Olá <b>'.$formulario["nome"].'</b>,<br>
				<br>
				Agradecemos sua visita e a oportunidade de recebermos o seu contato. Em breve você receberá um e-mail contendo a resposta para sua questão.<br>
				<br>
				<b><u>Observação - Não é necessário responder esta mensagem.</b></u>
			';
			if(empty($destino))
				$destino = "atek@atek.com.br";
			$Funcao->enviarEmail($destino, $assunto, $conteudoEmail, "", "atek@atek.com.br");
			$Funcao->enviarEmail($destinoGeral, $assunto, $conteudoEmail, "", "atek@atek.com.br");
			$Funcao->enviarEmail($formulario["email"], $assuntoCliente, $conteudoEmailCliente, "", "atek@atek.com.br");
		}
	}
?>