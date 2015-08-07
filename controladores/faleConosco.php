<?php
	if(!empty($campo))
		$formulario = array($campo => $valor);
	$erros = array();
	$existeErro = false;
	foreach($formulario as $campoId => $campoValor){
		$erros[$campoId] = array();
		$configFormulario = $FaleConosco->formulario;
		$campoConfig = $configFormulario[$campoId];
		if(is_array($campoConfig)){
			foreach($campoConfig as $chave => $valor)
				$$chave = $valor;
			if(is_array($removerCaracteres)){
				foreach($removerCaracteres as $caractere){
					$campoValor = str_replace($caractere, "", $campoValor);
					$formulario[$campoId] = $campoValor;
				}
			}
			if($tipo == "texto"){
				if($obrigatorio){
					if(strlen($campoValor) == 0)
						$erros[$campoId][] = "O preenchimento desse campo � obrigat�rio.";
				}
				if(($obrigatorio) OR (strlen($campoValor) > 0)){
					if(count($erros[$campoId]) == 0){
						if($minlength > 0)
							if(strlen($campoValor) < $minlength)
								$erros[$campoId][] = "Esse campo precisa ter no m�nimo $minlength caracteres.";
					}
					if(count($erros[$campoId]) == 0){
						if($maxlength > 0)
							if(strlen($campoValor) > $maxlength)
								$erros[$campoId][] = "Esse campo pode ter no m�ximo $maxlength caracteres.";
					}
					if(count($erros[$campoId]) == 0){
						if($tipoDadosObrigatorio["numeros"])
							if(!preg_match('/[0-9]+/', $campoValor))
								$erros[$campoId][] = "Esse campo precisa ter n�meros.";
					}
					if(count($erros[$campoId]) == 0){
						if($tipoDadosObrigatorio["letras"])
							if(!preg_match('/[A-Za-z]+/', $campoValor))
								$erros[$campoId][] = "Esse campo precisa ter letras.";
					}
					if(count($erros[$campoId]) == 0){
						if(!$tipoDados["numeros"])
							if(preg_match('/[0-9]+/', $campoValor))
								$erros[$campoId][] = "Esse campo n�o pode ter n�meros.";
					}
					if(count($erros[$campoId]) == 0){
						if(!$tipoDados["letras"])
							if(preg_match('/[A-Za-z]+/', $campoValor))
								$erros[$campoId][] = "Esse campo n�o pode ter letras.";
					}
					if(count($erros[$campoId]) == 0){
						if(!$tipoDados["simbolos"])
							if(!preg_match('/^[a-z0-9 .\-]+$/i', $campoValor))
								$erros[$campoId][] = "Esse campo n�o deve conter s�mbolos.";
					}
					if(count($erros[$campoId]) == 0){
						if($tipoDadosObrigatorio["email"])
							if(!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/', $campoValor))
								$erros[$campoId][] = "Esse e-mail � inv�lido.";
					}
				}
			}
			elseif($tipo == "lista"){
				if($obrigatorio){
					if(strlen($campoValor) == 0)
						$erros[$campoId][] = "Escolher um item desse campo � obrigat�rio.";
				}
			}
			if(count($erros[$campoId]) > 0)
				$existeErro = true;
		}
	}
	foreach($erros as $chave => $mensagem)
		$erros[$chave][0] = utf8_encode($mensagem[0]);
	echo json_encode($erros);
	if((!$existeErro) AND (empty($campo))){
		$sql = array(
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
		);
		$colunas = array();
		$valores = array();
		foreach($sql as $c => $v){
			$colunas[] = $c;
			$valores[] = $v;
		}
		mysql_query($Funcao->carregarInsertSQL("tickets", $colunas, $valores));
		$FaleConosco->enviarEmail($formulario);
	}
?>