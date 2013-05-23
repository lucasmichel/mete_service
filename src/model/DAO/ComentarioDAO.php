<?php
 class ComentarioDAO extends classDAO{
 	/**
 	 * Atributos
 	 */
 	private static $instancia;
 	private $conexao;
 	
 	const TABELA = 'comentario';
 	
 	/**
 	 * Metodo construtor()
 	 */
 	protected function __construct() {
 		//passa pra a classe pai o nomeda tabelausada pela classe
 		parent::__construct("comentario");
 		$this->conexao = Connect::getInstancia();
 	}
 	
 	public static function getInstancia() {
            if (!isset(self::$instancia))
                    self::$instancia = new ComentarioDAO();
            return self::$instancia;
 	}
 	
 	
 	public function inserir(Comentario $obj) {
            // INSTRUCAO SQL //
            $sql = "INSERT INTO " . self::TABELA . "
            (comentario,acompanhante_id, cliente_id, data_cadastro)
            VALUES('" . $obj->getComentario() . "' ,
            '" . $obj->getAcompanhanteId() . "',
            '" . $obj->getClienteId() . "', NOW())";

            // EXECUTANDO A SQL //
            $resultado = $this->conexao->exec($sql);
            // TRATANDO O RESULTADO //
            ($resultado) ? $obj->setId(mysql_insert_id()) : $obj = $resultado;
            // RETORNANDO O RESULTADO //
            return $obj;
            }
 	
 	public function editar(Comentario $obj) {
            //meuVarDump($obj->getId());
            // INSTRUCAO SQL 
            $sql = "UPDATE " . self::TABELA . " SET
                    comentario = '" . $obj->getComentario() . "'              
                    WHERE id = '" . $obj->getId() . "'";
            // EXECUTANDO A SQL //
            $resultado = $this->conexao->exec($sql);
            // RETORNANDO O RESULTADO /////
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
        
 	/**
 	 * Metodo listar($ordenarPor)
 	 * @return fetch_assoc[]
 	 */
 	public function listarPorIdCliente($id) {
 		// INSTRUCAO SQL //
 		$sql = "SELECT * FROM " . self::TABELA . "
            where cliente_id = '".$id."' and excluido = '0' ";
 		//meuVarDump($sql);
 		// EXECUTANDO A SQL //
 		$resultado = $this->conexao->fetchAll($sql);
 		// RETORNANDO O RESULTADO //
 		return $resultado;
 	}
 }

?>