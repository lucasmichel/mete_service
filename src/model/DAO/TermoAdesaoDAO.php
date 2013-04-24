<?php
/**
 * Classe TermoAdesaoDAO - criada por kayky lopes
 * Camada de acesso a dados da entidade TermoAdesao
 * @package model
 * @subpackage DAO
 */
class TermoAdesaoDAO extends ClassDAO{
	/**
	 * Atributos
	 */
	private static $instancia;
	private $conexao;
	
	const TABELA = 'termoAdesao';
	
	/**
	 * Metodo construtor()
	 */
	protected function __construct() {
		//passa pra a classe pai o nomeda tabelausada pela classe
		parent::__construct("termoAdesao");
		$this->conexao = Connect::getInstancia();
	}
	

	/**
	 * Metodo getInstancia()
	 */
	public static function getInstancia() {
		if (!isset(self::$instancia))
			self::$instancia = new TermoAdesaoDAO();
		return self::$instancia;
	}
	
	public function inserir(Avaliacao $obj) {
		// INSTRUCAO SQL //
		$sql = "INSERT INTO " . self::TABELA . "
            (ip, browser, data,usuario_id,usuario_id_perfil
            )
	
            VALUES('" . $obj->getIp() . "',
            '" . $obj->getBrowser() . "',
             '" . $obj->getData() . "',
            '" . $obj->getUsuarioId() . "',
             '" . $obj->getUsuarioIdPerfil() . "',)";
	
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
            ip = '" . $obj->getIp() . "',
            browser =	'" . $obj->getBrowser() . "',
            data = '" . $obj->getData() . "'
            usuario_id = '" . $obj->getUsuarioId() . "'
            usuario_id_perfil = '" . $obj->getUsuarioIdPerfil() . "'
            WHERE id = '" . $obj->getId() . "'";
		// EXECUTANDO A SQL //
		$resultado = $this->conexao->exec($sql);
		// RETORNANDO O RESULTADO //
		return $resultado;
	}
	
	public function excluir($id) {
		// checando se existe algum vinculo desse registro com outros //
		$validacao = "SELECT t.id FROM termoAdesao t WHERE t.id = '" . $id . "'";
		if ($this->conexao->fetch($validacao))
			throw new RegistroNaoExcluido(RegistroNaoExcluido::TERMOADESAO);
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
		$sql = "SELECT t.* FROM " . self::TABELA . " t WHERE t.id = '" . $id . "'";
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
		$sql = "SELECT t.* FROM " . self::TABELA . " t ORDER BY t.browser";
		// EXECUTANDO A SQL //
		$resultado = $this->conexao->fetchAll($sql);
		// RETORNANDO O RESULTADO //
		return $resultado;
	}
}

?>