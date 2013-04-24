<?php

/**
 * Classe ClienteDAO
 * Camada de acesso a dados da entidade Cliente
 * @package model
 * @subpackage DAO
 */
class ClienteDAO extends ClassDAO {

    /**
     * Atributos
     */
    private static $instancia;
    private $conexao;

    const TABELA = 'cliente';

    /**
     * Metodo construtor()
     */
    protected function __construct() {
        //passa pra a classe pai o nomeda tabelausada pela classe
        parent::__construct("cliente");
        $this->conexao = Connect::getInstancia();
    }

    /**
     * Metodo getInstancia()
     */
    public static function getInstancia() {
        if (!isset(self::$instancia))
            self::$instancia = new ClienteDAO();
        return self::$instancia;
    }

    /**
     * Metodo inserir($obj)
     * @param $obj
     * @return Perfil
     */
    public function inserir(Cliente $obj) {
        // INSTRUCAO SQL //
        $sql = "INSERT INTO " . self::TABELA . "
            (nome, cpf,  
			excluido, usuarios_id, usuarios_id_perfil
            ) 
            
            VALUES('" . $obj->getNome() . "',
            '" . $obj->getCpf() . "',            
			'0',
            '" . $obj->getUsuarioId() . "',
            '" . $obj->getUsuarioIdPerfil() . "')";
        
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
     * @return Perfil
     */
    public function editar(Cliente $obj) {
        // INSTRUCAO SQL //
        $sql = "UPDATE " . self::TABELA . " SET 
            nome = '" . $obj->getNome() . "',
            cpf =	'" . $obj->getCpf() . "'            
            WHERE id = '" . $obj->getId() . "'";
        // EXECUTANDO A SQL //
        $resultado = $this->conexao->exec($sql);
        // RETORNANDO O RESULTADO //
        return $resultado;
    }
    
    
    
    
    /**
     * Metodo testarCpfExiste($cpf)
     * @param $email
     * @return fetch_assoc
     */
    public function testarCpfExiste($cpf) {
    	// INSTRUCAO SQL //
    	$sql = "SELECT u.* FROM " . self::TABELA . " u
                        WHERE u.cpf = '" . $cpf . "'";
    	// EXECUTANDO A SQL //
    	$resultado = $this->conexao->fetch($sql);
    	// RETORNANDO O RESULTADO //
    	return $resultado;
    }
    
    
    /**
     * Metodo testarCpfExisteEdicao($id, $cpf)
     * @param $email
     * @return fetch_assoc
     */
    public function testarCpfExisteEdicao($id, $cpf) {
    	// INSTRUCAO SQL //
    	$sql = "SELECT u.* FROM " . self::TABELA . " u
                        WHERE u.cpf = '" . $cpf . "' AND
                        u.id <> " . $id . "";
    	// EXECUTANDO A SQL //
    	$resultado = $this->conexao->fetch($sql);
    	// RETORNANDO O RESULTADO //
    	return $resultado;
    }

    

    

    

}

?>