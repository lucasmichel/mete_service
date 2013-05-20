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
    const SERVICOS_DO_ENCONTRO = 12;
    const ENCONTRO = 13;
    
    public function __construct($tipo) {
        switch ($tipo) {
            case self::ACOES:
                $msg = 'Nenhuma não encontrada.';
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
            case self::CLIENTES:
            	$msg = 'Nenhum cliente encontrado.';
                break;
            case self::FOTOS:
            	$msg = 'Nenhuma foto encontrada.';
                break;
            case self::SERVICOS_ACOMPANHNATE:
            	$msg = 'Nenhum servico foi encontrado para esta acomanhante.';
                break;
            case self::COMENTARIO:
                $msg = 'Nenhum comentario encontrada.';
                break;
            case self::AVALIACAO:
                $msg = 'Nenhuma avalição encontrada.';
                break;
            case self::SERVICOS_DO_ENCONTRO:
                $msg = 'Nenhum serviço do encontro localizado.';
                break;
            case self::ENCONTRO:
                $msg = 'Nenhum encontro localizado.';
                break;
            	
        }
        parent::__construct($msg);
    }

}

?>