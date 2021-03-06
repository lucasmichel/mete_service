<?php

/**
 * Classe UsuarioDAO
 * Camada de acesso a dados da entidade Usuario
 * @package model
 * @subpackage DAO
 */
class UsuarioDAO extends ClassDAO {

    /**
     * Atributos
     */
    private static $instancia;
    private $conexao;

    const TABELA = 'usuarios';

    /**
     * Metodo construtor()
     */
    protected function __construct() {
        //passa pra a classe pai o nomeda tabelausada pela classe
        parent::__construct("usuarios");
        $this->conexao = Connect::getInstancia();
    }

    /**
     * Metodo getInstancia()
     */
    public static function getInstancia() {
        if (!isset(self::$instancia))
            self::$instancia = new UsuarioDAO();
        return self::$instancia;
    }

    /**
     * Metodo inserir($obj)
     * @param $obj
     * @return Usuario
     */
    public function inserir(Usuario $obj) {
        // INSTRUCAO SQL //
        $sql = "INSERT INTO " . self::TABELA . "(id_perfil,login,senha,email,excluido) 
                        VALUES('" . $obj->getPerfil()->getId() . "',
			'" . $obj->getLogin() . "',
                        '" . md5($obj->getSenha()) . "',
                        '" . $obj->getEmail() . "',
                        0)";
        // EXECUTANDO A SQL //
        $resultado = $this->conexao->exec($sql);
        // TRATANDO O RESULTADO //
        ($resultado) ? $obj->setId(mysql_insert_id()) : $obj = $resultado;
        // RETORNANDO O RESULTADO //
        return $obj;
    }

    /**
     * Metodo editar($obj)
     * @param $obj
     * @return Usuario
     */
    public function editar(Usuario $obj) {
        // INSTRUCAO SQL //
        /*
        echo '<pre>';
        echo 'Sem cripto: '.$obj->getSenha();
        echo 'Com cripto: '.md5($obj->getSenha());
        echo '<br/>';
         */
        $sql = "UPDATE " . self::TABELA . " SET 
        		id_perfil = '" . $obj->getPerfil()->getId() . "',
                login =	'" . $obj->getLogin() . "',
				senha = '" . md5($obj->getSenha()) . "',
				email = '" . $obj->getEmail() . "'
                WHERE id = '" . $obj->getId() . "'";
        //meuVarDump($sql);
        // EXECUTANDO A SQL //
        $resultado = $this->conexao->exec($sql);
        // RETORNANDO O RESULTADO //
        return $resultado;
    }

    /**
     * Metodo logar($login,$senha)
     * @param $login
     * @param $senha
     * @return fetch_assoc
     */
    public function logar($login, $senha) {
        // INSTRUCAO SQL //
                $sql = "SELECT u.* FROM " . self::TABELA . " u 
                        WHERE u.email = '" . $login . "' AND 
                        u.senha = '" . md5($senha) . "' AND u.excluido = 0";
        // EXECUTANDO A SQL //
        $resultado = $this->conexao->fetch($sql);
        // RETORNANDO O RESULTADO //                        
        return $resultado;
    }

    /**
     * Metodo buscar($id)
     * @param $id
     * @return fetch_assoc
     */
    /*public function buscar($id) {
        // INSTRUCAO SQL //
        $sql = "SELECT u.* FROM " . self::TABELA . " u WHERE u.id = '" . $id . "'";
        // EXECUTANDO A SQL //
        $resultado = $this->conexao->fetch($sql);
        // RETORNANDO O RESULTADO //
        return $resultado;
    }*/

    

    /**
     * Metodo trocarSenha($id,$senhaAtual,$novaSenha)
     * @param $id
     * @param $senhaAtual
     * @param $novaSenha
     * @return boolean
     */
    public function trocarSenha($id, $senhaAtual, $novaSenha) {
        // checando se a senha atual está correta //
        if (!$this->conexao->fetch("SELECT u.id FROM " . self::TABELA . " u WHERE u.id = '" . $id . "' AND u.senha = '" . md5($senhaAtual) . "'"))
            throw new SenhaInvalida();
        // instrução sql //
        $sql = "UPDATE " . self::TABELA . " SET senha = '" . md5($novaSenha) . "' WHERE id = '" . $id . "'";
        // executando a sql //
        $resultado = $this->conexao->exec($sql);
        // retornando o resultado //
        return $resultado;
    }

    /**
     * Metodo gravarDataHoraLogin($id)
     * @param $id
     */
    public function gravarDataHoraLogin($id) {
        // instrução sql //
        $sql = "UPDATE " . self::TABELA . " SET dataUltimoLogin = CURRENT_TIMESTAMP() WHERE id = '" . $id . "'";
        // executando a sql //
        $resultado = $this->conexao->exec($sql);
        // retornando o resultado //
        return $resultado;
    }
    
    
    /**
     * Metodo testarEmailExiste($email)
     * @param $email
     * @return fetch_assoc
     */
    public function testarEmailExiste($email) {
    	// INSTRUCAO SQL //
    	$sql = "SELECT u.* FROM " . self::TABELA . " u
                        WHERE u.email = '" . $email . "'";
    	// EXECUTANDO A SQL //    	
    	$resultado = $this->conexao->fetch($sql);
    	// RETORNANDO O RESULTADO //
    	return $resultado;
    }
    
    
    /**
     * Metodo testarEmailExisteEdicao($email, $id)
     * @param $email
     * @return fetch_assoc
     */
    public function testarEmailExisteEdicao($id, $email) {
    	// INSTRUCAO SQL //
    	$sql = "SELECT u.* FROM " . self::TABELA . " u 
                        WHERE u.email = '" . $email . "' AND 
                        u.id <> " . $id . "";
    	// EXECUTANDO A SQL //
    	$resultado = $this->conexao->fetch($sql);
    	// RETORNANDO O RESULTADO //
    	return $resultado;
    }
    
}

?>