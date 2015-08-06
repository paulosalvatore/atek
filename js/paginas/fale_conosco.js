function inserirValidacao(tipo, campo, mensagem){
	if(tipo == "erro"){
		$("#"+campo)
		.closest("td")
		.find(".mensagemErro")
		.html(mensagem)
		.closest("td")
		.find(".imagem")
		.addClass("errado")
		.removeClass("certo")
		.closest("tr")
		.find(".exibicaoBloco")
		.css({
			color: "red"
		});
	}
	else if(tipo == "sucesso"){
		$("#"+campo)
		.closest("td")
		.find(".mensagemErro")
		.html("")
		.closest("td")
		.find(".imagem")
		.addClass("certo")
		.removeClass("errado")
		.closest("tr")
		.find(".exibicaoBloco")
		.css({
			color: ""
		});
	}
}

function verificarCampo(campo, valor){
	$.ajax({
		url: "controladores/faleConosco.php",
		data:({
			campo: campo,
			valor: valor
		}),
		// dataType: "json",
		success: function(result){
			console.log(result);
			$.each(result, function(index, value){
				if(value != "")
					inserirValidacao("erro", index, value);
				else
					inserirValidacao("sucesso", index);
			});
		}
	}).responseText;
}

function verificarCampos(formulario){
	$("#faleConosco input:submit").val("Aguarde...").prop("disabled", true).blur();
	$("#faleConosco input:reset").prop("disabled", true);
	$("#faleConosco input:text, #faleConosco select").prop("readonly", true);
	$(".jqte_editor").attr("contenteditable", false);
	var retorno = true;
	$.ajax({
		url: "controladores/faleConosco.php",
		data:({
			formulario: formulario
		}),
		dataType: "json",
		success: function(result){
			console.log(result);
			$.each(result, function(index, value){
				if(value != ""){
					inserirValidacao("erro", index, value);
					retorno = false;
				}
				else
					inserirValidacao("sucesso", index);
			});
		},
		complete: function(result){
			$("#faleConosco input:submit").val("Enviar").prop("disabled", false);
			$("#faleConosco input:reset").prop("disabled", false);
			$("#faleConosco input:text, #faleConosco select").prop("readonly", false);
			$(".jqte_editor").attr("contenteditable", true);
			if(retorno){
				$("html, body").animate({
					scrollTop: ($(".titulo").offset().top)+"px"
				}, 1000);
				$("#mensagemEnviada").show();
				$("#faleConosco input:reset").click();
				$("#conteudoFaleConosco").hide();
			}
		}
	}).responseText;
}

$(function(){
	$("#faleConosco input:text, #faleConosco textarea, #faleConosco select").blur(function(){
		verificarCampo($(this).attr("name"), $(this).val());
	});

	$("#faleConosco").submit(function(){
		verificarCampos($(this).serialize());
		return false;
	});

	$("#enviarNovaMensagem").click(function(){
		$("#mensagemEnviada").hide();
		$("#conteudoFaleConosco").show();
	});

	$("#faleConosco input:reset").click(function(){
		$(this)
		.closest("form")
		.find(".mensagemErro")
		.each(function(){
			$(this).html("");
		});
		$(".jqte_editor").html("");
	});

	$("#faleConosco #telefone")
	.mask("(99) 9999-9999?9")
	.change(function(){
		if($(this).val().length > 14)
			$(this).mask("(99) 99999-999?9");
		else
			$(this).mask("(99) 9999-9999?9");
	});

	$("#mensagem").jqte({
		p: false,
		format: false,
		fsize: false,
		sub: false,
		sup: false,
		strike: false,
		outdent: false,
		indent: false,
		left: false,
		center: false,
		right: false,
		link: false,
		unlink: false,
		titletext:[
			{title: "Formato do Texto"},
			{title: "Tamanho da Fonte"},
			{title: "Cor"},
			{title: "Negrito", hotkey: "B"},
			{title: "Itálico", hotkey: "I"},
			{title: "Sublinhado", hotkey: "U"},
			{title: "Lista Ordenada", hotkey: "."},
			{title: "Lista Simples", hotkey: ","},
			{title: "Subscript", hotkey: "down arrow"},
			{title: "Superscript", hotkey: "up arrow"},
			{title: "Sem Parágrafo", hotkey: "left arrow"},
			{title: "Parágrafo", hotkey: "right arrow"},
			{title: "Justificar à Esquerda"},
			{title: "Justificar ao Centro"},
			{title: "Justificar à Direita"},
			{title: "Linha Atravessada", hotkey: "K"},
			{title: "Adicionar Link", hotkey: "L"},
			{title: "Remover Link", hotkey: ""},
			{title: "Limpar Estilo", hotkey: "Delete"},
			{title: "Linha Horizontal", hotkey: "H"},
			{title: "Código-Fonte", hotkey: ""}
		],
		blur: function(){
			$("textarea").blur();
		}
	});

	$("#faleConosco #cep").keydown(function(event){
		if(event.keyCode == 13){
			$("#localizarCep").click();
			return false;
		}
		else{
			if(($(this).val().length == 5) && (event.keyCode != 8))
				$(this).val($(this).val()+"-");
			if((event.keyCode == 8) && ($(this).val().length == 7))
				$(this).val($(this).val().substr(0, 6));
			return true;
		}
	});

	$("#localizarCep").click(function(){
		$("#cep").cep({
			load: function(){
				$("#localizarCep")
				.attr("src", "imagens/conteudo/carregando2.gif")
				.attr("title", "Aguarde ...")
				.attr("id", "localizarCepCarregando");
			},
			complete: function(){
				$("#localizarCepCarregando")
				.attr("src", "imagens/conteudo/pesquisar2.png")
				.attr("title", "Localizar CEP")
				.attr("id", "localizarCep");
			},
			error: function(msg){
				inserirValidacao("erro", "cep", msg);
				$("#cep").css("background", "#FFFFC5").css("color", "red");
			},
			success: function(data){
				$("#cidade").val(data.cidade);
				$("#estado").val(data.estado);
				$("#cep").css("background", "#FFFFFF").css("color", "black");
			}
		});
	});
});