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
 			self::$instancia = new CaracteristicasDAO();
 		return self::$instancia;
 	}
 	
 	
 	public function inserir(Fotos $obj) {
 		// INSTRUCAO SQL //
 		$sql = "INSERT INTO " . self::TABELA . "
            (comentario,comentario_id,cliente_id,acompanhante_id)
            VALUES('" . $obj->getComentario() . "' ,
            '" . $obj->getComentario_id() . "' ,
            '" . $obj->getCliente_id() . "' ,
            '" . $obj->getAcompanhante_id() . "')";
 		// EXECUTANDO A SQL //
 		$resultado = $this->conexao->exec($sql);
 		// TRATANDO O RESULTADO //
 	}
 	
 	public function editar(Acompanhante $obj) {
 		// INSTRUCAO SQL //
 		$sql = "UPDATE " . self::TABELA . " SET
            comentario = '" . $obj->getComentario() . "',
            comentario_id =	'" . $obj->getComentario_id() . "',
            cliente_id = '" .  $obj->getCliente_id() . "',
            acompanhante_id = '" .$obj->getAcompanhante_id() . "'
            WHERE id = '" . $obj->getId() . "'";
 		// EXECUTANDO A SQL //
 		$resultado = $this->conexao->exec($sql);
 		// RETORNANDO O RESULTADO //
 		return $resultado;
 	}
 }

?>