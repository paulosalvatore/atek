<?php
	class Funcao {
		public function limparString($string){
			$a = "��������������������������������������������������������������Rr' ";
			$b = "AAAAAAACEEEEIIIIDNOOOOOOUUUUYBSaaaaaaaceeeeiiiidnoooooouuuyybyRr +";
			$string = strtr($string, $a, $b);
			$string = str_replace(".", "", $string);
			$string = str_replace("�", "", $string);
			$string = str_replace("�", "", $string);
			$string = str_replace("�", "", $string);
			$string = str_replace("%", "", $string);
			return $string;
		}
	}
?>