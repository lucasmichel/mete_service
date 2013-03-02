<?php

/**
 * Classe ListaVazia
 * @package model
 * @subpackage exception
 * @author Idealizza
 */
class RegistroNaoExcluido extends Exception {
    /**
     * Constantes
     */
    const PERFIL = 1;

    public function __construct($tipo) {
        switch ($tipo) {
            case self::PERFIL:
                $msg = 'Não é possível excluir este perfil, existem usuários associados ao mesmo.';
                break;
        }
        parent::__construct($msg);
    }

}

?>
