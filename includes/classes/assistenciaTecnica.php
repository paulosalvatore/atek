<?php
	class AssistenciaTecnica {
		public function pegarRelacao(){
			$exibirRelacao = "";
			$assistenciasLocalizacao = array();
			// $assistencias = array();
			$queryAssistenciasLocalizacao = mysql_query("SELECT * FROM assistencias_localizacao ORDER BY ordem ASC");
			while($resultadoAssistenciasLocalizacao = mysql_fetch_assoc($queryAssistenciasLocalizacao))
				$assistenciasLocalizacao[$resultadoAssistenciasLocalizacao["id"]] = $resultadoAssistenciasLocalizacao;
			$queryAssistencias = mysql_query("SELECT * FROM assistencias ORDER BY ordem ASC");
			while($resultadoAssistencias = mysql_fetch_assoc($queryAssistencias))
				$assistenciasLocalizacao[$resultadoAssistencias["localizacao"]]["assistencias"][] = $resultadoAssistencias;
			foreach($assistenciasLocalizacao as $localizacaoId => $localizacao){
				$exibirRelacao .= '
					<div class="titulo">
						'.$localizacao["descricao"].'
					</div>
				';
				foreach($localizacao["assistencias"] as $ordem => $assistencia){
					$exibirRelacao .= '
						<div class="assistenciaTecnica">
							'.($assistencia["imagem"] ? ($assistencia["site"] ? '
							<a href="'.$assistencia["site"].'" target="blank">' : "").'
								<img src="imagens/assistenciaTecnica/'.$assistencia["imagem"].'">
							'.($assistencia["site"] ? '</a>' : "").'<br>' : "").'
							'.($assistencia["razao_social"] ? '<b>'.$assistencia["razao_social"].'</b><br>' : "").'
							'.($assistencia["endereco"] ? $assistencia["endereco"].'<br>' : "").'
							'.($assistencia["telefone"] ? '<b>Telefone:</b> '.$assistencia["telefone"].'<br>' : "").'
							'.($assistencia["fax"] ? '<b>Fax:</b> '.$assistencia["fax"].'<br>' : "").'
							'.($assistencia["email"] ? '<b>E-mail:</b> <a href="mailto:'.$assistencia["email"].'">'.$assistencia["email"].'</a><br>' : "").'
							'.($assistencia["site"] ? '<b>Site:</b> <a href="'.$assistencia["site"].'" target="_new">'.str_replace("http://", "", $assistencia["site"]).'</a><br>' : "").'
						</div>
					';
				}
			}
			return $exibirRelacao;
		}
	}
?>