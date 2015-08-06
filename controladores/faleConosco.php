<?php
	session_start();
	require_once("../conexao/conexao.php");
	/*
	include("../../includes/funcoes.php");
	include("../../includes/enviarEmail.php");
	check_is_ajax(__FILE__);
	include("../../includes/protocolo.php");
	include("../../includes/data.php");
	include("../../includes/carregar_produtos.php");
	include("../../includes/configuracoes/fale_conosco.php");
	foreach($_REQUEST as $c => $v)
		$$c = $v;
	parse_str(addslashes($formulario), $formulario);
	if(!empty($campo))
		$formulario = array($campo => $valor);
	$erros = array();
	$existe_erro = false;
	foreach($formulario as $id_campo => $valor_campo){
		$erros[$id_campo] = array();
		$config_campo = $config_formulario[$id_campo];
		if(is_array($config_campo)){
			foreach($config_campo as $chave => $valor)
				$$chave = $valor;
			if(is_array($remover_caracteres)){
				foreach($remover_caracteres as $caractere){
					$valor_campo = str_replace($caractere, "", $valor_campo);
					$formulario[$id_campo] = $valor_campo;
				}
			}
			if($tipo == "texto"){
				if($obrigatorio){
					if(strlen($valor_campo) == 0)
						$erros[$id_campo][] = "O preenchimento desse campo é obrigatório.";
				}
				if(($obrigatorio) OR (strlen($valor_campo) > 0)){
					if(count($erros[$id_campo]) == 0){
						if($minlength > 0)
							if(strlen($valor_campo) < $minlength)
								$erros[$id_campo][] = "Esse campo precisa ter no mínimo $minlength caracteres.";
					}
					if(count($erros[$id_campo]) == 0){
						if($maxlength > 0)
							if(strlen($valor_campo) > $maxlength)
								$erros[$id_campo][] = "Esse campo pode ter no máximo $maxlength caracteres.";
					}
					if(count($erros[$id_campo]) == 0){
						if($tipo_dados_obrigatorio["numeros"])
							if(!preg_match('/[0-9]+/', $valor_campo))
								$erros[$id_campo][] = "Esse campo precisa ter números.";
					}
					if(count($erros[$id_campo]) == 0){
						if($tipo_dados_obrigatorio["letras"])
							if(!preg_match('/[A-Za-z]+/', $valor_campo))
								$erros[$id_campo][] = "Esse campo precisa ter letras.";
					}
					if(count($erros[$id_campo]) == 0){
						if(!$tipo_dados["numeros"])
							if(preg_match('/[0-9]+/', $valor_campo))
								$erros[$id_campo][] = "Esse campo não pode ter números.";
					}
					if(count($erros[$id_campo]) == 0){
						if(!$tipo_dados["letras"])
							if(preg_match('/[A-Za-z]+/', $valor_campo))
								$erros[$id_campo][] = "Esse campo não pode ter letras.";
					}
					if(count($erros[$id_campo]) == 0){
						if(!$tipo_dados["simbolos"])
							if(!preg_match('/^[a-z0-9 .\-]+$/i', $valor_campo))
								$erros[$id_campo][] = "Esse campo não deve conter símbolos.";
					}
					if(count($erros[$id_campo]) == 0){
						if($tipo_dados_obrigatorio["email"])
							if(!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/', $valor_campo))
								$erros[$id_campo][] = "Esse e-mail é inválido.";
					}
				}
			}
			elseif($tipo == "lista"){
				if($obrigatorio){
					if(strlen($valor_campo) == 0)
						$erros[$id_campo][] = "Escolher um item desse campo é obrigatório.";
				}
			}
			if(count($erros[$id_campo]) > 0)
				$existe_erro = true;
		}
	}
	foreach($erros as $chave => $mensagem)
		$erros[$chave][0] = utf8_encode($mensagem[0]);
	echo json_encode($erros);
	if((!$existe_erro) AND (empty($campo))){
		foreach($formulario as $chave => $valor)
			$formulario[$chave] = utf8_decode($valor);
		$sql_queries = array(
			"tickets" => array(
				"setor" => $formulario["setor"],
				"nome" => $formulario["nome"],
				"email" => $formulario["email"],
				"cep" => $formulario["cep"],
				"cidade" => $formulario["cidade"],
				"estado" => $formulario["estado"],
				"assunto" => $formulario["assunto"],
				"telefone" => $formulario["telefone"],
				"mensagem" => $formulario["mensagem"],
				"orcamento" => $formulario["orcamento"],
				"ip" => $ip,
				"data" => time()
			)
		);
		foreach($sql_queries as $tabela => $query){
			$sql_query = "INSERT INTO $tabela (";
			for($i=0;$i<2;$i++){
				$j = 0;
				foreach($query as $coluna => $valor){
					if($j > 0)
						$sql_query .= ", ";
					if($i == 0)
						$sql_query .= "$coluna";
					else
						$sql_query .= "'$valor'";
					$j++;
				}
				if($i == 0)
					$sql_query .= ") VALUES (";
				else
					$sql_query .= ");";
			}
			mysql_query($sql_query);
		}
		if(!empty($formulario["telefone"])){
			$ddd = substr($formulario["telefone"], 0, 2);
			if(strlen($formulario["telefone"]) == 10)
				$wr = 4;
			elseif(strlen($formulario["telefone"]) == 11)
				$wr = 5;
			$telefone = wordwrap(substr($formulario["telefone"], 2, 9), $wr, "-", true);
			$exibir_telefone = "(".$ddd.") ".$telefone;
		}
		$conteudo_email = '
			<style>
				.conteudo_email {
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
			<div class="conteudo_email">
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
						$conteudo_email .= '
							<tr>
								<td width="150">
									<b>Telefone:</b>
								</td>
								<td>
									'.$exibir_telefone.'
								</td>
							</tr>
						';
					$conteudo_email .= '
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
						$conteudo_email .= '
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
						$conteudo_email .= '
							<tr>
								<td width="150">
									<b>Assunto:</b>
								</td>
								<td>
									'.$formulario["assunto"].'
								</td>
							</tr>
						';
					$conteudo_email .= '
					<tr>
						<td colspan="2">
							<b>Mensagem:</b><br>
							<div class="mensagem">
								'.$formulario["mensagem"].'
							</div>
						</td>
					</tr>
				</table>
				';
				$orcamento = array();
				if(!empty($formulario["orcamento"])){
					$checar_orcamento = mysql_fetch_array(mysql_query("SELECT COUNT(*) as total FROM orcamentos_site WHERE (orcamento LIKE '".$formulario["orcamento"]."')"));
					$checar_orcamento_produtos = mysql_fetch_array(mysql_query("SELECT COUNT(*) as total FROM orcamentos_site_produtos WHERE (orcamento LIKE '".$formulario["orcamento"]."')"));
					if(($checar_orcamento["total"] == 1) AND ($checar_orcamento_produtos["total"] >= 1)){
						$conteudo_email .= '
							<br><br>
							<table class="orcamento" cellpadding="0" cellspacing="0">
								<tr class="cabecalho_orcamento">
									<td width="50%">
										Produto
									</td>
									<td width="20%">
										Quantidade
									</td>
									<td width="15%">
										Preço Unitário
									</td>
									<td width="15%">
										Subtotal
									</td>
								</tr>
								';
								$sql = "SELECT * FROM orcamentos_site_produtos WHERE (orcamento LIKE '".$formulario["orcamento"]."')";
								$query = mysql_query($sql);
								while ($resultado = mysql_fetch_assoc($query)) {
									$produto = $resultado["produto"];
									$quantidade = $resultado["quantidade"];
									$orcamento[$produto] = $quantidade;
								}
								foreach($orcamento as $produto => $quantidade){
									$codigo = $orcamento_produtos[$produto]["codigo"];
									$descricao = $orcamento_produtos[$produto]["descricao"];
									$preco_antigo = $orcamento_produtos[$produto]["preco_antigo"];
									$exibir_preco_antigo = number_format($preco_antigo, 2, ',', '.');
									$preco = $orcamento_produtos[$produto]["preco"];
									$exibir_preco = number_format($preco, 2, ',', '.');
									$imagem = "http://www.atek.com.br/".$orcamento_produtos[$produto]["imagem"];
									$exibicao_preco = "";
									if($preco_antigo != $preco)
										$exibicao_preco = '
											<span class="preco_antigo">De: '.$exibir_preco_antigo.'</span><br>Por:
										';
									$exibicao_preco .= "R$ ".$exibir_preco;
									$subtotal = $preco*$quantidade;
									$exibir_subtotal = "R$ ".number_format($subtotal, 2, ',', '.');
									$total += $subtotal;
									$total_desconto += $subtotal*0.95;
									$conteudo_email .= '
										<tr class="principal">
											<td colspan="4">
												<table width="100%" cellspacing="0" cellpadding="0">
													<tr class="produto_orcamento" align="center">
														<td width="20%" class="imagem">
															<img src="'.$imagem.'" border="0">
														</td>
														<td width="30%" class="descricao">
															'.$codigo.' - '.utf8_decode($descricao).'
														</td>
														<td width="20%" class="quantidade">
															'.$quantidade.'
														</td>
														<td width="15%" class="preco">
															'.$exibicao_preco.'
														</td>
														<td width="15%" class="subtotal">
															<span>'.$exibir_subtotal.'</span>
														</td>
													</tr>
												</table>
											</td>
										</tr>
									';
								}
								if($total < 450)
									$parcelas = 1;
								else if($total < 1000)
									$parcelas = 3;
								else if($total < 2000)
									$parcelas = 4;
								else
									$parcelas = 5;
								$valor_parcela = $total/$parcelas;
								$total = number_format($total, 2, ',', '.');
								$total_desconto = number_format($total_desconto, 2, ',', '.');
								$valor_parcela = number_format($valor_parcela, 2, ',', '.');
								$conteudo_email .= '
								<tr class="valores_orcamento">
									<td colspan="4">
										Total a prazo: R$ '.$total.'
									</td>
								</tr>
								<tr class="valores_orcamento">
									<td colspan="4">
										Em '.$parcelas.' parcelas sem juros de R$ '.$valor_parcela.'
									</td>
								</tr>
								<tr class="valores_orcamento">
									<td colspan="4">
										Total à vista (desconto: 5%): R$ '.$total_desconto.'
									</td>
								</tr>
							</table>
						';
					}
				}
				$conteudo_email .= '
				Mensagem enviada em <b>'.$data.' às '.$horario.'</b>.
			</div>
		';
		$conteudo_email = utf8_encode($conteudo_email);
		$destino_geral = "contato@atek.com.br";
		if(($formulario["setor"] == "vendas") OR ($formulario["setor"] == "outros"))
			$destino = "atek@atek.com.br";
		if($formulario["setor"] == "assistencia_tecnica")
			$destino = "assistenciatecnica@atek.com.br";
		$assunto = $formulario["assunto"];
		if(empty($assunto))
			$assunto = "Sem assunto";
		$assunto = utf8_encode($assunto);
		$assunto_cliente = "Sua mensagem foi recebida";
		$conteudo_email_cliente = '
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
		enviarEmail($destino, $assunto, $conteudo_email, "ATEK FLASH SYSTEM", "atek@atek.com.br");
		enviarEmail($destino_geral, $assunto, $conteudo_email, "ATEK FLASH SYSTEM", "atek@atek.com.br");
		enviarEmail($formulario["email"], $assunto_cliente, utf8_encode($conteudo_email_cliente), "ATEK FLASH SYSTEM", "atek@atek.com.br");
	}
	*/
?>