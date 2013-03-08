<?php
/**
 * Classe CamposObrigatorios
 * @package model
 * @subpackage exception
 */
	class CamposObrigatorios extends Exception {

		public function __construct(){
			parent::__construct('Preencha os campos obrigatórios');
		}

	}
?>