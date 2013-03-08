<?php
/**
 * Classe ListaVazia
 * @package model
 * @subpackage exception
 */
	class ListaVazia extends Exception {
		
		/**
		 * Constantes
		 */
		const ACOES = 1;
		const MODULOS = 2;
		const PERFIS = 3;
		const USUARIOS = 4;
		
		public function __construct($tipo){
			switch($tipo){
				case self::ACOES:
					$msg = 'Nenhuma ação encontrada.';
					break;
				case self::MODULOS:
					$msg = 'Nenhum modulo encontrado.';
					break;
				case self::PERFIS:
					$msg = 'Nenhum perfil encontrado.';
					break;
				case self::USUARIOS:
					$msg = 'Nenhum usuário encontrado.';
					break;
			}
			parent::__construct($msg);
		}

	}
?>