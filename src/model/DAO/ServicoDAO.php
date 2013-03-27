<?php
class  ServicoDAO extends  ClassDAO{
	/**
	 * Atributos
	 */
	private static $instancia;
	private $conexao;
	
	const TABELA = 'servico';
	
	/**
	 * Metodo construtor()
	 */
	protected function __construct() {
		//passa pra a classe pai o nomeda tabelausada pela classe
		parent::__construct("servico");
		$this->conexao = Connect::getInstancia();
	}
	
	public static function getInstancia() {
		if (!isset(self::$instancia))
			self::$instancia = new ServicoDAO();
		return self::$instancia;
	}
	
	public function inserir(Servico $obj) {
		// INSTRUCAO SQL //
		$sql = "INSERT INTO " . self::TABELA . "
            (nome,)
            VALUES('" . $obj->getNome() . "')";
	
		// EXECUTANDO A SQL //
		$resultado = $this->conexao->exec($sql);
		// TRATANDO O RESULTADO //
	}
	 
	public function editar(Servico $obj) {
		// INSTRUCAO SQL //
		$sql = "UPDATE " . self::TABELA . " SET
            nome = '" . $obj->getNome() . "'
            WHERE id = '" . $obj->getId() . "'";
		// EXECUTANDO A SQL //
		$resultado = $this->conexao->exec($sql);
		// RETORNANDO O RESULTADO /////
		return $resultado;
	}
	
	public function setAcoes($servico) {
		// INSTRUCAO SQL //
		$sql = "SELECT s.nome FROM servico s
					WHERE s.id = '" . $servico . "'
					ORDER BY s.id";
		// EXECUTANDO A SQL //
		$resultado = $this->conexao->fetchAll($sql);
		// RETORNANDO O RESULTADO //
		return $resultado;
	}
	
	public function excluir($id) {
		// checando se existe algum vinculo desse registro com outros //
		$validacao = "SELECT s.id FROM servico s WHERE s.id = '" . $id . "'";
		if ($this->conexao->fetch($validacao))
			throw new RegistroNaoExcluido(RegistroNaoExcluido::SERVICO);
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
		$sql = "SELECT s.* FROM " . self::TABELA . " s WHERE s.id = '" . $id . "'";
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
		$sql = "SELECT s.* FROM " . self::TABELA . " s ORDER BY s.nome";
		// EXECUTANDO A SQL //
		$resultado = $this->conexao->fetchAll($sql);
		// RETORNANDO O RESULTADO //
		return $resultado;
	}
	
	
}

?>