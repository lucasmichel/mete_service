<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FotosDAO
 *
 * @author kaykylopes
 */
class FotosDAO  extends ClassDAO{
     /**
     * Atributos
     */
    private static $instancia;
    private $conexao;

    const TABELA = 'fotos';
    
     /**
     * Metodo construtor()
     */
    protected function __construct() {
        //passa pra a classe pai o nomeda tabelausada pela classe
        parent::__construct("fotos");
        $this->conexao = Connect::getInstancia();
    }
    
      public static function getInstancia() {
        if (!isset(self::$instancia))
            self::$instancia = new FotosDAO();
        return self::$instancia;
    }
    
     public function inserir(Fotos $obj) {
        // INSTRUCAO SQL //
        $sql = "INSERT INTO " . self::TABELA . "
            (nome,acompanhante_id) 
            VALUES('" . $obj->getNome() . "',
            '" . $obj->getAcompanhante_id() . "')";
        
        // EXECUTANDO A SQL //
        $resultado = $this->conexao->exec($sql);
        // TRATANDO O RESULTADO //
     }
     
       public function editar(Fotos $obj) {
        // INSTRUCAO SQL //
        $sql = "UPDATE " . self::TABELA . " SET 
            nome = '" . $obj->getNome() . "',
            acompanhante_id = '" . $obj->getAcompanhante_id() . "'
            WHERE id = '" . $obj->getId() . "'";
        // EXECUTANDO A SQL //
        $resultado = $this->conexao->exec($sql);
        // RETORNANDO O RESULTADO /////
        return $resultado;
    }
    
     public function setAcoes($fotos) {
        // INSTRUCAO SQL //
        $sql = "SELECT f.nome,f.acompanhante_id FROM fotos f
					WHERE f.id = '" . $fotos . "'
					ORDER BY f.id";
        // EXECUTANDO A SQL //
        $resultado = $this->conexao->fetchAll($sql);
        // RETORNANDO O RESULTADO //
        return $resultado;
    }

}

?>
