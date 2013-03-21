<?php
class CaracteristicasDAO extends ClassDAO{
	/**
	 * Atributos
	 */
	private static $instancia;
	private $conexao;
	
	const TABELA = 'caracteristicas';
	
	/**
	 * Metodo construtor()
	 */
	protected function __construct() {
		//passa pra a classe pai o nomeda tabelausada pela classe
		parent::__construct("caracteristicas");
		$this->conexao = Connect::getInstancia();
	}
	
	public static function getInstancia() {
		if (!isset(self::$instancia))
			self::$instancia = new CaracteristicasDAO();
		return self::$instancia;
	}
	
	
	public function inserir(Fotos $obj) {
		// INSTRUCAO SQL //
		$sql = "INSERT INTO " . self::TABELA . "
            (nome,)
            VALUES('" . $obj->getNome() . "')";	
		// EXECUTANDO A SQL //
		$resultado = $this->conexao->exec($sql);
		// TRATANDO O RESULTADO //
	}
	 
	public function editar(Fotos $obj) {
		// INSTRUCAO SQL //
		$sql = "UPDATE " . self::TABELA . " SET
            nome = '" . $obj->getNome() . "'
            WHERE id = '" . $obj->getId() . "'";
		// EXECUTANDO A SQL //
		$resultado = $this->conexao->exec($sql);
		// RETORNANDO O RESULTADO /////
		return $resultado;
	}
	
	public function setAcoes($caracteristicas) {
		// INSTRUCAO SQL //
		$sql = "SELECT c.nome FROM caracteristicas c
					WHERE c.id = '" . $caracteristicas . "'
					ORDER BY c.id";
		// EXECUTANDO A SQL //
		$resultado = $this->conexao->fetchAll($sql);
		// RETORNANDO O RESULTADO //
		return $resultado;
	}
}

?>