$(function(){
	$("input:submit, button, .button").button();

	if($("#consultaProdutos").val() == "")
		$("#consultaProdutos").focus();

	$("#consultaProdutos").keypress(function(event){
		if((event.keyCode == 13) && ($(this).val() != ""))
			$("#buscarProdutos").click();
	});

	$("#buscarProdutos").click(function(){
		if($("#consultaProdutos").val() != ""){
			var consulta = encodeURIComponent($("#consultaProdutos").val());
			document.location = "?p=busca&c="+consulta;
		}
	});
});