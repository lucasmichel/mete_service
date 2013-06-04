<?php
/**
 * Classe LocalizacaoDAO - criada por kayky lopes
 * Camada de acesso a dados da entidade Localizacao
 * @package model
 * @subpackage DAO
 */
 class LocalizacaoDAO extends ClassDAO{
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
 	
 	public function inserir(Localizacao $obj) {
 		// INSTRUCAO SQL //
 		$sql = "INSERT INTO " . self::TABELA . "
                (latitude, longitude,endereco_formatado,servicos_acompanhante_id
                )

                VALUES('" . $obj->getLatitude() . "',
                '" . $obj->getLongitude() . "',
                '" . $obj->getEnderecoFormatado() . "',
                '" . $obj->getServicoAcompanhanteId() . "')";
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
 	public function editar(Localizacao $obj) {
 		// INSTRUCAO SQL //
 		$sql = "UPDATE " . self::TABELA . " SET
                latitude = '" . $obj->getLatitude() . "',
                longitude =	'" . $obj->getLongitude() . "',
                endereco_formatado = '" . $obj->getEnderecoFormatado() . "',            
                servico_acompanhante_id = '" . $obj->getServicoAcompanhanteId() . "'
                WHERE id = '" . $obj->getId() . "'";
 		// EXECUTANDO A SQL //
 		$resultado = $this->conexao->exec($sql);
 		// RETORNANDO O RESULTADO //
 		return $resultado;
 	}
 	
 	/*public function excluir($id) {
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
 	}*/
 	

 	public function buscar($id) {
 		// INSTRUCAO SQL //
 		$sql = "SELECT l.* FROM " . self::TABELA . " l WHERE l.id = '" . $id . "' and l.excluido = 0 ";
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
 		$sql = "SELECT * FROM " . self::TABELA . " where excluido = 0 ";
 		// EXECUTANDO A SQL //
 		$resultado = $this->conexao->fetchAll($sql);
 		// RETORNANDO O RESULTADO //
 		return $resultado;
 	}
        
        
 	/**
 	 * Metodo listar()
 	 * @return fetch_assoc[]
 	 */
 	public function listarPorServicoAcompanhanteId($ServicoAcompanhanteId) {
 		// INSTRUCAO SQL //
 		$sql = "SELECT * FROM " . self::TABELA . " where servicos_acompanhante_id = '".$ServicoAcompanhanteId."' and excluido = 0";
 		// EXECUTANDO A SQL //
 		$resultado = $this->conexao->fetchAll($sql);
 		// RETORNANDO O RESULTADO //
 		return $resultado;
 	}
 	
 }

?>