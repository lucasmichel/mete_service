<?php
/**
 * Classe ModuloDAO
 * Camada de acesso a dados da entidade Modulo
 * @package model
 * @subpackage DAO
 */
	class ModuloDAO {

		/**
		 * Atributos
		 */
		private static $instancia;
		private $conexao;	
		const TABELA = 'modulos';

		/**
		 * Metodo construtor()
		 */
		private function __construct(){	
			$this->conexao = Connect::getInstancia();
		}
		
		/**
		 * Metodo getInstancia()
		 */
		public static function getInstancia(){
			if(!isset(self::$instancia))
				self::$instancia = new ModuloDAO();
			return self::$instancia;
		}
		
		public function inserir(Avaliacao $obj) {
			// INSTRUCAO SQL //
			$sql = "INSERT INTO " . self::TABELA . "
            (nome, link)
            VALUES('" . $obj->getNome() . "',
            '" . $obj->getLink() . "')";
		
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
            nome = '" . $obj->getNome() . "',
            link =	'" . $obj->getLink() . "'   
            WHERE id = '" . $obj->getId() . "'";
			// EXECUTANDO A SQL //
			$resultado = $this->conexao->exec($sql);
			// RETORNANDO O RESULTADO //
			return $resultado;
		}
		
		public function excluir($id) {
			// checando se existe algum vinculo desse registro com outros //
			$validacao = "SELECT m.id FROM modulo m WHERE m.id = '" . $id . "'";
			if ($this->conexao->fetch($validacao))
				throw new RegistroNaoExcluido(RegistroNaoExcluido::MODULO);
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
		
		/**
		 * Metodo buscar($id)
		 * @param $id
		 * @return fetch_assoc
		 */
		public function buscar($id){
			// INSTRUCAO SQL //
			$sql = "SELECT m.* FROM " . self::TABELA . " m WHERE m.id = '".$id."'";
			// EXECUTANDO A SQL //
			$resultado = $this->conexao->fetch($sql);
			// RETORNANDO O RESULTADO //
			return $resultado;
		}
		
		/**
		 * Metodo listar()
		 * @return fetch_assoc[]
		 */
		public function listar(){
			// INSTRUCAO SQL //
			$sql = "SELECT m.* FROM " . self::TABELA . " m ORDER BY m.nome";
			// EXECUTANDO A SQL //
			$resultado = $this->conexao->fetchAll($sql);
			// RETORNANDO O RESULTADO //
			return $resultado;
		}

	}
?>