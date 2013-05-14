<?php
 class ComentarioDAO extends classDAO{
 	/**
 	 * Atributos
 	 */
 	private static $instancia;
 	private $conexao;
 	
 	const TABELA = 'comentario';
 	
 	/**
 	 * Metodo construtor()
 	 */
 	protected function __construct() {
 		//passa pra a classe pai o nomeda tabelausada pela classe
 		parent::__construct("comentario");
 		$this->conexao = Connect::getInstancia();
 	}
 	
 	public static function getInstancia() {
 		if (!isset(self::$instancia))
 			self::$instancia = new ComentarioDAO();
 		return self::$instancia;
 	}
 	
 	
 	public function inserir(Fotos $obj) {
 		// INSTRUCAO SQL //
 		$sql = "INSERT INTO " . self::TABELA . "
            (comentario,clienteId,acompanhanteId)
            VALUES('" . $obj->getComentario() . "' ,
            '" . $obj->getClienteId() . "' ,
            '" . $obj->getAcompanhanteId() . "')";
 		// EXECUTANDO A SQL //
 		$resultado = $this->conexao->exec($sql);
 		// TRATANDO O RESULTADO //
 	}
 	
 	public function editar(Acompanhante $obj) {
 		// INSTRUCAO SQL //
 		$sql = "UPDATE " . self::TABELA . " SET
            comentario = '" . $obj->getComentario() . "',
            clienteId = '" .  $obj->getClienteId() . "',
            acompanhanteId = '" .$obj->getAcompanhanteId() . "'
            WHERE id = '" . $obj->getId() . "'";
 		// EXECUTANDO A SQL //
 		$resultado = $this->conexao->exec($sql);
 		// RETORNANDO O RESULTADO //
 		return $resultado;
 	}
 	
 	public function excluir($id) {
 		// checando se existe algum vinculo desse registro com outros //
 		$validacao = "SELECT c.id FROM comentario c WHERE c.id = '" . $id . "'";
 		if ($this->conexao->fetch($validacao))
 			throw new RegistroNaoExcluido(RegistroNaoExcluido::COMENTARIO);
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
 		$sql = "SELECT c. * FROM " . self::TABELA . " c  WHERE c.id = '" . $id . "'";
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
 		$sql = "SELECT * FROM " . self::TABELA . " c ORDER BY c.comentario";
 		// EXECUTANDO A SQL //
 		$resultado = $this->conexao->fetchAll($sql);
 		// RETORNANDO O RESULTADO //
 		return $resultado;
 	}
 	/**
 	 * Metodo listar($ordenarPor)
 	 * @return fetch_assoc[]
 	 */
 	public function listarPorIdAcompanhante($id) {
 		// INSTRUCAO SQL //
 		$sql = "SELECT * FROM " . self::TABELA . "
            where acompanhanteId = '".$id."' and excluido = '0' ";
 		//meuVarDump($sql);
 		// EXECUTANDO A SQL //
 		$resultado = $this->conexao->fetchAll($sql);
 		// RETORNANDO O RESULTADO //
 		return $resultado;
 	}
 }

?>