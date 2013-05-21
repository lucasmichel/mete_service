<?php
class RegistroNaoEncontrado extends Exception {	
    const ACAO = 1;
    const MODULO = 2;
    const PERFIL = 3;
    const USUARIO = 4;
    const ACOMPANHANTE = 5;
    const SERVICO = 6;
    const CLIENTE = 7;
    const COMENTARIO = 8;
    const  AVALIACAO = 9;
    const  SERVICOS_DO_ECONTRO = 10;
    const  ECONTRO = 11;
    const  LOCALIZACAO = 12;

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
                case self::AVALIACAO:
                        $msg = 'Avaliacao não encontrado.';
                        break;
                case self::SERVICOS_DO_ECONTRO:
                        $msg = 'Serviço do encontro não encontrado.';
                        break;
                case self::ECONTRO:
                        $msg = 'Encontro não encontrado.';
                        break;
                case self::LOCALIZACAO:
                        $msg = 'Localização não encontrada.';
                        break;
                        	
        }
        parent::__construct($msg);
    }
}
?>