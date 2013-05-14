<?php
class ServicoDAO extends ClassDAO{
	/**
	 * Description of Acompanhante
	 *
	 * @author kaykylopes
	 */
	
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
            (nome, excluido)
            VALUES('" . $obj->getNome() . "', 0)";
	
		// EXECUTANDO A SQL //
		$resultado = $this->conexao->exec($sql);
		// TRATANDO O RESULTADO //
                return $resultado;
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
	
	
	/**
	 * Metodo testarEmailExiste($email)
	 * @param $email
	 * @return fetch_assoc
	 */
	public function testarServicoExiste($nome) {
		// INSTRUCAO SQL //
		$sql = "SELECT u.* FROM " . self::TABELA . " u
                        WHERE u.nome = '" . $nome . "'";
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
	public function testarServicoExisteEdicao($id, $nome) {
		// INSTRUCAO SQL //
		$sql = "SELECT u.* FROM " . self::TABELA . " u
                        WHERE u.nome = '" . $nome . "' AND
                        u.id <> " . $id . "";
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
	public function buscarServicoPorIdParaWebService($idServico) {
		// INSTRUCAO SQL //
		$sql = "SELECT u.* FROM " . self::TABELA . " u
                        WHERE u.id = '" . $idServico . "' AND
                        u.excluido <> 1";
		// EXECUTANDO A SQL //
		$resultado = $this->conexao->fetch($sql);
		// RETORNANDO O RESULTADO //
		return $resultado;
	}	
}

?>