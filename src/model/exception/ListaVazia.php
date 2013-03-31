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
    const ACOMPANHANTES = 5;
    const SERVICOS = 6;

    public function __construct($tipo) {
        switch ($tipo) {
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
            case self::ACOMPANHANTES:
                $msg = 'Nenhuma acompanhante encontrada.';
                break;
			case self::SERVICOS:
            	$msg = 'Nenhum serviço encontrado.';
                break;
        }
        parent::__construct($msg);
    }

}

?>