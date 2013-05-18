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
    const CLIENTES = 7;
    const FOTOS = 8;
    const SERVICOS_ACOMPANHNATE = 9;
    const COMENTARIO = 10;
    const AVALIACAO = 11;
    
    public function __construct($tipo) {
        switch ($tipo) {
            case self::ACOES:
                $msg = 'Nenhuma aчуo encontrada.';
                break;
            case self::MODULOS:
                $msg = 'Nenhum modulo encontrado.';
                break;
            case self::PERFIS:
                $msg = 'Nenhum perfil encontrado.';
                break;
            case self::USUARIOS:
                $msg = 'Nenhum usuсrio encontrado.';
                break;
            case self::ACOMPANHANTES:
                $msg = 'Nenhuma acompanhante encontrada.';
                break;
            case self::SERVICOS:
            	$msg = 'Nenhum serviчo encontrado.';
                break;
            case self::CLIENTES:
            	$msg = 'Nenhum cliente encontrado.';
                break;
            case self::FOTOS:
            	$msg = 'Nenhuma foto encontrada.';
                break;
            case self::SERVICOS_ACOMPANHNATE:
            	$msg = 'Nenhum servico foi encontrado para esta acomanhante.';
            	case self::COMENTARIO:
            		$msg = 'Nenhum comentario encontrada.';
            		break;
            case self::AVALIACAO:
            			$msg = 'Nenhuma avaliчуo encontrada.';
            			break;
            	break;
        }
        parent::__construct($msg);
    }

}

?>