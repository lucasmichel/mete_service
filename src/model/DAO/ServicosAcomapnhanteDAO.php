<?php
class ServicosAcomapnhanteDAO extends ClassDAO{
	/**
	 * Description of Acompanhante
	 *
	 * @author Lucas Michel
	 */
	
	/**
	 * Atributos
	 */
	private static $instancia;
	private $conexao;
	
	const TABELA = 'servicos_acompanhante';
	
	/**
	 * Metodo construtor()
	 */
	protected function __construct() {
		//passa pra a classe pai o nomeda tabelausada pela classe
		parent::__construct("servicos_acompanhante");
		$this->conexao = Connect::getInstancia();
	}
	
	public static function getInstancia() {
		if (!isset(self::$instancia))
			self::$instancia = new ServicosAcomapnhanteDAO();
		return self::$instancia;
	}
	
	public function inserir(ServicosAcompanhante $obj) {
		// INSTRUCAO SQL //
		$sql = "INSERT INTO " . self::TABELA . "
                (servico_id, valor, acompanhante_id, excluido)VALUES(
                    '" . $obj->getServicoId()  . "', 
                    '" . $obj->getValor()  . "',
                    '" . $obj->getAcompanhanteId()  . "',                    
                0)";
		// EXECUTANDO A SQL //
		$resultado = $this->conexao->exec($sql);
                // TRATANDO O RESULTADO //
                ($resultado) ? $obj->setId(mysql_insert_id()) : $obj = $resultado;
		
                return $obj;
	}
	 
	public function editar(ServicosAcompanhante $obj) {		
                // INSTRUCAO SQL //
		$sql = "UPDATE " . self::TABELA . " SET
                servico_id = '" . $obj->getServicoId() . "',
                valor = '" . $obj->getValor() . "',
                acompanhante_id = '" . $obj->getServicoId() . "',
                excluido = '0'
                
                WHERE id = '" . $obj->getId() . "'";
	
		// EXECUTANDO A SQL //
		$resultado = $this->conexao->exec($sql);
		// TRATANDO O RESULTADO //
                return $resultado;
	}
	
	
/**
     * Metodo listar($ordenarPor)     
     * @return fetch_assoc[]
     */
    public function listarPorIdAcompanhante($id) {
    	// INSTRUCAO SQL //
    	$sql = "SELECT * FROM " . self::TABELA . " 
            where acompanhante_id = '".$id."' and excluido = '0' ";
    	//meuVarDump($sql);
    	// EXECUTANDO A SQL //
    	$resultado = $this->conexao->fetchAll($sql);
    	// RETORNANDO O RESULTADO //
    	return $resultado;
    }
	
	
	
}

?>