<?php
class RegistroNaoEncontrado extends Exception {	
    const ACAO = 1;
    const MODULO = 2;
    const PERFIL = 3;
    const USUARIO = 4;

    public function __construct($tipo){
        switch($tipo){
                case self::ACAO:
                        $msg = 'Ação não encontrada.';
                        break;
                case self::MODULO:
                        $msg = 'Modulo não encontrado.';
                        break;
                case self::PERFIL:
                        $msg = 'Perfil não encontrado.';
                        break;
                case self::USUARIO:
                        $msg = 'Usuário não encontrado.';
                        break;
        }
        parent::__construct($msg);
    }
}
?>