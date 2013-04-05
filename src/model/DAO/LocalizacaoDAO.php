<?php
/**
 * Classe LocalizacaoDAO - criada por kayky lopes
 * Camada de acesso a dados da entidade Localizacao
 * @package model
 * @subpackage DAO
 */
 class LocalizacaoDAO extends ClasseDAO{
 	/**
 	 * Atributos
 	 */
 	private static $instancia;
 	private $conexao;
 	
 	const TABELA = 'localizacao';
 	
 	/**
 	 * Metodo construtor()
 	 */
 	protected function __construct() {
 		//passa pra a classe pai o nomeda tabelausada pela classe
 		parent::__construct("localizacao");
 		$this->conexao = Connect::getInstancia();
 	}
 	
 	/**
 	 * Metodo getInstancia()
 	 */
 	public static function getInstancia() {
 		if (!isset(self::$instancia))
 			self::$instancia = new LocalizacaoDAO();
 		return self::$instancia;
 	}
 	
 	public function inserir(Avaliacao $obj) {
 		// INSTRUCAO SQL //
 		$sql = "INSERT INTO " . self::TABELA . "
            (latitude, longitude,bairro,cidade,servico_acompanhante_id
            )
 	
            VALUES('" . $obj->getLatitude() . "',
            '" . $obj->getLongitude() . "',
            '" . $obj->getBairro() . "',
            '" . $obj->getCidade() . "',
            '" . $obj->getgetBairro() . "',
            		'" . $obj->getServicoAcompanhanteId() . "',)";	
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
            latitude = '" . $obj->getLatitude() . "',
            longitude =	'" . $obj->getLongitude() . "',
            bairro = '" . $obj->getBairro() . "'
            cidade = '" . $obj->getCidade() . "'
            servico_acompanhante_id = '" . $obj->getServicoAcompanhanteId() . "'
            WHERE id = '" . $obj->getId() . "'";
 		// EXECUTANDO A SQL //
 		$resultado = $this->conexao->exec($sql);
 		// RETORNANDO O RESULTADO //
 		return $resultado;
 	}
 	
 	public function excluir($id) {
 		// checando se existe algum vinculo desse registro com outros //
 		$validacao = "SELECT l.id FROM localizacao l WHERE l.id = '" . $id . "'";
 		if ($this->conexao->fetch($validacao))
 			throw new RegistroNaoExcluido(RegistroNaoExcluido::LOCALIZACAO);
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
 		$sql = "SELECT l.* FROM " . self::TABELA . " l WHERE l.id = '" . $id . "'";
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
 		$sql = "SELECT l.* FROM " . self::TABELA . " l ORDER BY l.cidade";
 		// EXECUTANDO A SQL //
 		$resultado = $this->conexao->fetchAll($sql);
 		// RETORNANDO O RESULTADO //
 		return $resultado;
 	}
 	
 }

?>