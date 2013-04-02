<?php
/**
 * Classe AcompanhanteDAO - criada por kayky lopes
 * Camada de acesso a dados da entidade Acompanhante
 * @package model
 * @subpackage DAO
 */
 class AvaliacaoDAO extends ClasseDAO{
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
            (nota, cliente_id, acompanhante_id
            )
 	
            VALUES('" . $obj->getNota() . "',
            '" . $obj->getClienteId() . "',
            '" . $obj->getAcompanhanteId() . "')";

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
 		$sql = "UPDATE " . self::TABELA . " SET
            nota = '" . $obj->getNota() . "',
            cliente_id =	'" . $obj->getClienteId() . "',
            acompanhante_id = '" . $obj->getAcompanhanteId() . "'
            WHERE id = '" . $obj->getId() . "'";
 		// EXECUTANDO A SQL //
 		$resultado = $this->conexao->exec($sql);
 		// RETORNANDO O RESULTADO //
 		return $resultado;
 	}
 	
 	public function excluir($id) {
 		// checando se existe algum vinculo desse registro com outros //
 		$validacao = "SELECT a.id FROM avaliacao a WHERE a.id = '" . $id . "'";
 		if ($this->conexao->fetch($validacao))
 			throw new RegistroNaoExcluido(RegistroNaoExcluido::FOTOS);
 		// INSTRUCOES SQL //
 		$sql[] = "DELETE FROM " . self::TABELA . " WHERE id = '" . $id . "'";
 		// PERCORRENDO AS SQL //
 		foreach ($sql as $item) {
 			// EXECUTANDO A SQL //
 			$resultado = $this->conexao->exec($item);
 		}
 		// RETORNANDO O RESULTADO //
 		return $resultado;
 	}
 	
 	public function buscar($id) {
 		// INSTRUCAO SQL //
 		$sql = "SELECT a.* FROM " . self::TABELA . " a WHERE a.id = '" . $id . "'";
 		// EXECUTANDO A SQL //
 		$resultado = $this->conexao->fetch($sql);
 		// RETORNANDO O RESULTADO //
 		return $resultado;
 	}
 	
 	/**
 	 * Metodo listar()
 	 * @return fetch_assoc[]
 	 */
 	public function listar() {
 		// INSTRUCAO SQL //
 		$sql = "SELECT a.* FROM " . self::TABELA . " a ORDER BY a.nota";
 		// EXECUTANDO A SQL //
 		$resultado = $this->conexao->fetchAll($sql);
 		// RETORNANDO O RESULTADO //
 		return $resultado;
 	}
 	
 }

?>