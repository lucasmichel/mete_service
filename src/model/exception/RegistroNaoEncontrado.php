<?php
class RegistroNaoEncontrado extends Exception {	
    const ACAO = 1;
    const MODULO = 2;
    const PERFIL = 3;
    const USUARIO = 4;
    const ACOMPANHANTE = 5;
    const SERVICO = 6;
    const CLIENTE = 7;

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
                case self::ACOMPANHANTE:
                        $msg = 'Acompanhante não encontrada.';
                        break;
				case self::SERVICO:
                		$msg = 'Serviço não encontrado.';
                        break;
				case self::CLIENTE:
                		$msg = 'Cliente não encontrado.';
                        break;      
                case self::COMENTARIO:
                        	$msg = 'Comentario não encontrado.';
                        	break;
        }
        parent::__construct($msg);
    }
}
?>