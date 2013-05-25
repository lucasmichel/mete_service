<?php
/**
 * Classe AvaliacaoDAO - criada por kayky lopes
 * Camada de acesso a dados da entidade Avaliacao
 * @package model
 * @subpackage DAO
 */
 class AvaliacaoDAO extends ClassDAO{
 	/**
 	 * Atributos
 	 */
 	private static $instancia;
 	private $conexao;
 	
 	const TABELA = 'avaliacao';
 	
 	/**
 	 * Metodo construtor()
 	 */
 	protected function __construct() {
 		//passa pra a classe pai o nomeda tabelausada pela classe
 		parent::__construct("avaliacao");
 		$this->conexao = Connect::getInstancia();
 	}
 	
 	/**
 	 * Metodo getInstancia()
 	 */
 	public static function getInstancia() {
 		if (!isset(self::$instancia))
 			self::$instancia = new AvaliacaoDAO();
 		return self::$instancia;
 	}
 	
 	public function inserir(Avaliacao $obj) {
 		// INSTRUCAO SQL //
 		  $sql = "INSERT INTO " . self::TABELA . "
            (nota,acompanhante_id, cliente_id, data_cadastro)
            VALUES('" . $obj->getNota() . "' ,
            '" . $obj->getAcompanhanteId() . "',
            '" . $obj->getClienteId() . "', NOW())";

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
 	public function editar(Avaliacao $obj) {
 		// INSTRUCAO SQL //
 		//meuVarDump($obj->getId());
 		// INSTRUCAO SQL //
		    $sql = "UPDATE " . self::TABELA . " SET
                    nota = '" . $obj->getNota() . "'              
                    WHERE id = '" . $obj->getId() . "'";
            // EXECUTANDO A SQL //
            $resultado = $this->conexao->exec($sql);
            // RETORNANDO O RESULTADO /////
            return $resultado;
 	}
 	

 	public function listarPorIdAcompanhante($id) {
 		// INSTRUCAO SQL //
 		$sql = "SELECT * FROM " . self::TABELA . "
            where acompanhante_id = '".$id."' and excluido = '0' ";
 		//meuVarDump($sql);
 		// EXECUTANDO A SQL //
 		$resultado = $this->conexao->fetchAll($sql);
 		// RETORNANDO O RESULTADO //
 		return $resultado;
 	}
 	
 	public function listarPorIdCliente($id) {
 		// INSTRUCAO SQL //
 		$sql = "SELECT * FROM " . self::TABELA . "
            where cliente_id = '".$id."' and excluido = '0' ";
 		//meuVarDump($sql);
 		// EXECUTANDO A SQL //
 		$resultado = $this->conexao->fetchAll($sql);
 		// RETORNANDO O RESULTADO //
 		return $resultado;
 	}

 }

?>
