<?php
	$submenu = 14;
	$barraNavegacao = array("Assist�ncia T�cnica" => "?p=assistencia_tecnica");
	$ocultarTitulo = 1;
	$titulo = "Assist�ncia T�cnica";
	if($id == "como_enviar"){
		$titulo = "Como Enviar";
		$incluirConteudo = '
			<div class="titulo">
				Como Enviar seus Equipamentos para Nossa Assist�ncia T�cnica
			</div>
			<div class="conteudoPagina">
				Voc� pode enviar seus equipamentos para nossa assist�ncia t�cnica
				em S�o Paulo. Para despachar os equipamentos, embale os mesmos em
				caixa de papel�o ou outro material, certificando-se de proteg�-los
				com jornal amassado ou pl�stico bolha, para que n�o haja risco de
				danos ao mesmo durante a viagem. Ao enviar flashes ou tochas de
				geradores, certifique-se de colocar a tampa de prote��o das
				l�mpadas. Pode-se remeter os equipamentos via sedex.<br>
				<br>
				<span class="textoAzul"><b>Favor enviar tamb�m os seguintes
				dados para cadastro:</b><br>
				Nome:<br>
				CPF:<br>
				Endere�o Completo (para onde o flash dever� ser enviado ap�s o
				conserto):<br>
				Telefone:<br>
				E-mail:<br>
				Uma breve descri��o do problema apresentado:</span><br>
				<br>
				Flashes em garantia dever�o ser enviados <b>exclusivamente</b>
				para nossa assist�ncia t�cnica em S�o Paulo, acompanhados de c�pia
				da nota fiscal e do termo de garantia.<br>
				<br>
				A garantia restringe-se ao reparo do aparelho. A ATEK n�o se
				responsabiliza por despesas de frete ou transporte, preju�zos
				pelo per�odo de indisponibilidade ou quaisquer outros preju�zos
				pessoais ou materiais.<br>
				<br>
				<b>Endere�o para remessa do equipamento para conserto:</b><br>
				REFLECTA EQUIPAMENTOS LTDA<br>
				Rua Galv�o Bueno, 859 - Loja 01 � Liberdade<br>
				CEP 01506-000 - S�o Paulo - SP<br>
				<b>Telefone/Fax:</b> (11) 3272-0366/3209-3131<br>
			</div>
		';
	}
	elseif($id == "encontre"){
		$titulo = "Rela��o de Assist�ncias";
		$incluirConteudo = '
			<div class="conteudoPagina">
				<br>
				A <b>ATEK FLASH SYSTEM</b> n�o se responsabiliza por nenhuma assist�ncia t�cnica exceto a <b>Reflecta Equipamentos Ltda</b>.<br>
				<br>
				Confira abaixo, a lista de assist�ncias que trabalham com manuten��o de flashes de est�dio:
			</div>
			'.$AssistenciaTecnica->pegarRelacao().'
		';
	}
	else
		$barraNavegacao = "";
?>