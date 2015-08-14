<?php
	$submenu = 14;
	$barraNavegacao = array("Assistência Técnica" => "?p=assistencia_tecnica");
	$ocultarTitulo = 1;
	$titulo = "Assistência Técnica";
	if($id == "como_enviar"){
		$titulo = "Como Enviar";
		$incluirConteudo = '
			<div class="titulo">
				Como Enviar seus Equipamentos para Nossa Assistência Técnica
			</div>
			<div class="conteudoPagina">
				Você pode enviar seus equipamentos para nossa assistência técnica
				em São Paulo. Para despachar os equipamentos, embale os mesmos em
				caixa de papelão ou outro material, certificando-se de protegê-los
				com jornal amassado ou plástico bolha, para que não haja risco de
				danos ao mesmo durante a viagem. Ao enviar flashes ou tochas de
				geradores, certifique-se de colocar a tampa de proteção das
				lâmpadas. Pode-se remeter os equipamentos via sedex.<br>
				<br>
				<span class="textoAzul"><b>Favor enviar também os seguintes
				dados para cadastro:</b><br>
				Nome:<br>
				CPF:<br>
				Endereço Completo (para onde o flash deverá ser enviado após o
				conserto):<br>
				Telefone:<br>
				E-mail:<br>
				Uma breve descrição do problema apresentado:</span><br>
				<br>
				Flashes em garantia deverão ser enviados <b>exclusivamente</b>
				para nossa assistência técnica em São Paulo, acompanhados de cópia
				da nota fiscal e do termo de garantia.<br>
				<br>
				A garantia restringe-se ao reparo do aparelho. A ATEK não se
				responsabiliza por despesas de frete ou transporte, prejuízos
				pelo período de indisponibilidade ou quaisquer outros prejuízos
				pessoais ou materiais.<br>
				<br>
				<b>Endereço para remessa do equipamento para conserto:</b><br>
				REFLECTA EQUIPAMENTOS LTDA<br>
				Rua Galvão Bueno, 859 - Loja 01 – Liberdade<br>
				CEP 01506-000 - São Paulo - SP<br>
				<b>Telefone/Fax:</b> (11) 3272-0366/3209-3131<br>
			</div>
		';
	}
	elseif($id == "encontre"){
		$titulo = "Relação de Assistências";
		$incluirConteudo = '
			<div class="conteudoPagina">
				<br>
				A <b>ATEK FLASH SYSTEM</b> não se responsabiliza por nenhuma assistência técnica exceto a <b>Reflecta Equipamentos Ltda</b>.<br>
				<br>
				Confira abaixo, a lista de assistências que trabalham com manutenção de flashes de estúdio:
			</div>
			'.$AssistenciaTecnica->pegarRelacao().'
		';
	}
	else
		$barraNavegacao = "";
?>