<?php
class EncontroDAO extends ClassDAO{
	/**
	 * Atributos
	 */
	private static $instancia;
	private $conexao;
	
	const TABELA = 'encontro';
	
	/**
	 * Metodo construtor()
	 */
	protected function __construct() {
		//passa pra a classe pai o nomeda tabelausada pela classe
		parent::__construct("encontro");
		$this->conexao = Connect::getInstancia();
	}
	
	/**
	 * Metodo getInstancia()
	 */
	public static function getInstancia() {
		if (!isset(self::$instancia))
			self::$instancia = new EncontroDAO();
		return self::$instancia;
	}
	
	public function inserir(Encontro $obj) {
            // INSTRUCAO SQL //
            $sql = "INSERT INTO " . self::TABELA . "
            (cliente_id, data_horario, excluido)
            VALUES('" . $obj->getClienteId() . "',
            '" . $obj->getDataHorario() . "',
            '" . $obj->getExcluido() . "')";
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
	public function editar(Encontro $obj) {
            // INSTRUCAO SQL //
            $sql = "UPDATE " . self::TABELA . " SET
            cliente_id = '" . $obj->getClienteId() . "',
            data_horario =	'" . $obj->getData_horario() . "',
            excluido = '" . $obj->getExcluido() . "'
            WHERE id = '" . $obj->getId() . "'";
            // EXECUTANDO A SQL //
            $resultado = $this->conexao->exec($sql);
            // RETORNANDO O RESULTADO //
            return $resultado;
	}
	
        public function buscarSituacaoEcontro($idEcontro) {
            // INSTRUCAO SQL //
            /*$sql = "SELECT count(id) as total FROM servicos_do_encontro WHERE econtro_id = '" . $idEcontro . "' and aprovado = 1";
            // EXECUTANDO A SQL //
            $resultado = $this->conexao->fetch($sql);            
            foreach($resultado as $obj){
                $totAprovado = $obj['total'];
            }*/
            
            // INSTRUCAO SQL //
            $sql2 = "SELECT count(id) as total FROM servicos_do_encontro WHERE encontro_id = '" . $idEcontro . "' and aprovado = '0'";
            // EXECUTANDO A SQL //
            
            //meuVarDump($sql2);
            
            $resultado2 = $this->conexao->fetchAll($sql2);
            
            
            if($resultado2[0]["total"] == 0){
                return true;
            }
            else {
                return false;
            }
            
            
	}
        
	/*public function excluir($id) {
            // checando se existe algum vinculo desse registro com outros //
            $validacao = "SELECT e.id FROM encontro e WHERE e.id = '" . $id . "'";
            if ($this->conexao->fetch($validacao))
                    throw new RegistroNaoExcluido(RegistroNaoExcluido::ENCONTRO);
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
		$sql = "SELECT e.* FROM " . self::TABELA . " e WHERE e.id = '" . $id . "'";
		// EXECUTANDO A SQL //
		$resultado = $this->conexao->fetch($sql);
		// RETORNANDO O RESULTADO //
		return $resultado;
	}*/
	
	/**
	 * Metodo listar()
	 * @return fetch_assoc[]
	 */
	/*public function listar() {
		// INSTRUCAO SQL //
		$sql = "SELECT e.* FROM " . self::TABELA . " e ORDER BY e.aprovado";
		// EXECUTANDO A SQL //
		$resultado = $this->conexao->fetchAll($sql);
		// RETORNANDO O RESULTADO //
		return $resultado;
	}*/
	
	
}

?>