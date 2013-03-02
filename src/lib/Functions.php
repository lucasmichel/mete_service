<?php
	/**
	 * Função formataData($data)
	 * Inverte o formato da data para o formato oposto
	 * Formatos válidos: dd/mm/YYYY ou YYYY-mm-dd
	 * @param $data
	 * @return string
	 */
	function formataData($data){
		$temp = explode('/',$data);
		if(count($temp) == 3)
			return $temp[2] . "-" . $temp[1] . "-" . $temp[0];
		$temp = explode('-',$data);
		return (count($temp) == 3) ? $temp[2] . "/" . $temp[1] . "/" . $temp[0] : false;
	}
	
	function getAcaoAtual(){
		if(empty($_GET['url']))
			return 'index';
		return (count($temp = explode('/',$_GET['url'])) > 1) ? $temp[1] : 'index';
	}
	
?>