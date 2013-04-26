<?php
/**
 * Classe AcaoDAO
 * Camada de acesso a dados da entidade Ação
 * @package model
 * @subpackage DAO
 */
	class AcaoDAO extends ClassDAO {
		
		/**
		 * Atributos
		 */
		private static $instancia;
		private $conexao;	
		const TABELA = 'acoes';
		
		/**
		 * Metodo construtor()
		 */
		protected function __construct(){	
			parent::__construct("acoes");
			$this->conexao = Connect::getInstancia();
		}
		
		/**
		 * Metodo getInstancia()
		 */
		public static function getInstancia(){
			if(!isset(self::$instancia))
				self::$instancia = new AcaoDAO();
			return self::$instancia;
		}
		
		
		/**
		 * Metodo inserir($obj)
		 * @param $obj
		 * @return Perfil
		 */
		public function inserir(Acao $obj) {
			// INSTRUCAO SQL //
			$sql = "INSERT INTO " . self::TABELA . "
            (id_modulo, codigo_acao, nome, excluido)
		
            VALUES('" . $obj->getModulo()->getId() . "',
            '" . $obj->getCodigoAcao() . "',
            '" . $obj->getNome(). "', 0)";			
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
		public function editar(Acao $obj) {
			// INSTRUCAO SQL //
			$sql = "UPDATE " . self::TABELA . " SET
            nome = '" . $obj->getNome() . "'
            WHERE id_modulo = '" . $obj->getModulo()->getId() . "' and codigo_acao = '".$obj->getCodigoAcao()."' ";
			// EXECUTANDO A SQL //			
			$resultado = $this->conexao->exec($sql);
			// RETORNANDO O RESULTADO //
			return $obj;
		}
		
		
		/**
		 * Metodo buscar($codigo,$modulo)
		 * @param $codigo
		 * @param $modulo
		 * @return fetch_assoc
		 */
		public function buscar($codigo = 0,$modulo = 0){
			// FILTRO //
			$where = array();
			if(!empty($codigo))
				$where[] = " a.codigo_acao = '".$codigo."' ";
			if(!empty($modulo))
				$where[] = " a.id_modulo = '".$modulo."' ";
			$where = (count($where) ? ' WHERE ' . implode(' AND ',$where) : '');	
			// INSTRUCAO SQL //
			$sql = "SELECT a.* FROM " . self::TABELA . " a " . @$where. "and a.excluido = '0' ";                        
			// EXECUTANDO A SQL //			
			$resultado = $this->conexao->fetch($sql);
			// RETORNANDO O RESULTADO //
			return $resultado;
		}
		
		/**
		 * Metodo listar($filtroModulo)
		 * @param $filtroModulo
		 * @return fetch_assoc[]
		 */
		public function listarComFiltro($filtroModulo){
			// FILTRO //
			$where = array();
			if(!empty($filtroModulo))
				$where[] = " a.id_modulo = '".$filtroModulo."' ";
			$where = (count($where) ? ' WHERE ' . implode(' AND ',$where) : '');
			// INSTRUCAO SQL //
			$sql = "SELECT a.* FROM " . self::TABELA . " a "
							   . @$where .
							   " and a.excluido = '0' ORDER BY a.nome";
			// EXECUTANDO A SQL //
			$resultado = $this->conexao->fetchAll($sql);
			// RETORNANDO O RESULTADO //
			return $resultado;
		}
		
		
		
		
		public function listarPorModulo ($idModulo){
			// FILTRO //
			
			// INSTRUCAO SQL //
			$sql = "SELECT a.* FROM " . self::TABELA . " a 
					where a.id_modulo = '".$idModulo."' and a.excluido = '0' ORDER BY a.codigo_acao";
			
			// EXECUTANDO A SQL //
			$resultado = $this->conexao->fetchAll($sql);
			// RETORNANDO O RESULTADO //
			return $resultado;
		}
		
		public function buscarNomeAcao($nome, $modulo){			
			// INSTRUCAO SQL //
			$sql = "SELECT a.* FROM " . self::TABELA . " a 
					where a.nome = '".$nome."' and a.id_modulo = '".$modulo."' and a.excluido = '0'";
			// EXECUTANDO A SQL //			
			$resultado = $this->conexao->fetch($sql);
			// RETORNANDO O RESULTADO //
			return $resultado;
		}
		
		
		public function buscarCodigoAcao($codigoAcao, $modulo){
			// INSTRUCAO SQL //
			$sql = "SELECT a.* FROM " . self::TABELA . " a
					where a.codigo_acao = '".$codigoAcao."' and a.id_modulo = '".$modulo."' and a.excluido = '0'";
			// EXECUTANDO A SQL //			
			$resultado = $this->conexao->fetch($sql);
			// RETORNANDO O RESULTADO //
			return $resultado;
		}
		
		
		public function buscarNomeAcaoEdicao($id, $nome, $modulo){
			// INSTRUCAO SQL //
			$sql = "SELECT a.* FROM " . self::TABELA . " a
					where a.nome = '".$nome."' and a.id_modulo = '".$modulo."' and
							a.id <>'".$id."' and a.excluido = '0' ";
			// EXECUTANDO A SQL //
			$resultado = $this->conexao->fetch($sql);
			// RETORNANDO O RESULTADO //
			return $resultado;
		}
		
		
		public function buscarCodigoAcaoEdicao($id, $codigoAcao, $modulo){
			// INSTRUCAO SQL //
			$sql = "SELECT a.* FROM " . self::TABELA . " a
					where a.codigo_acao = '".$codigoAcao."' and a.id_modulo = '".$modulo."' and
							a.id <>'".$id."' and a.excluido = '0' ";
			
			// EXECUTANDO A SQL //
			$resultado = $this->conexao->fetch($sql);
			// RETORNANDO O RESULTADO //
			return $resultado;
		}
		
                
		public function excluirRelacionamentoAcaoModuloPerfil(Acao $obj){
                    
            $sql = "DELETE from acoes_modulos_perfis WHERE
            		 
            id_modulo = '" . $obj->getModulo()->getId() . "' 
            and codigo_acao = '".$obj->getCodigoAcao()."' ";
            
            // EXECUTANDO A SQL //
            $resultado = $this->conexao->fetch($sql);
            // RETORNANDO O RESULTADO //
        	return $resultado;
                    
        }
                
	}
?>