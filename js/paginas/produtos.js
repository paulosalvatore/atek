$(function(){
	var popup_altura = $("#popup").attr("altura");
	var popup_largura = $("#popup").attr("largura");
	var janela_largura = $(window).width();
	var janela_altura = $(window).height();
	if(popup_altura > janela_altura)
		popup_altura = janela_altura-150;
	if(popup_largura > janela_largura)
		popup_largura = janela_largura;
	$("#popup").dialog({
		height: popup_altura,
		width: popup_largura,
		modal: true,
		autoOpen: false,
		position: [100, 25],
		show: {
			effect: "fade",
			duration: 400
		},
		hide: {
			effect: "fade",
			duration: 400
		},
		open: function(){
			$(".ui-widget-overlay").bind("click",function(){
				$("#popup").dialog("close");
			});
		}
	});
	$(".imagemProduto img").click(function(){
		$("#popup").dialog("open");
	});
});