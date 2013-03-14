<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CassDAO
 *
 * @author softluc
 */
class ClassDAO {
    //put your code here
    
    private $conexao;	
    private $tabela;

    protected function __construct($tabela){	
            $this->tabela = $tabela;
            $this->conexao = Connect::getInstancia();
    }
    
    
    /**
     * Metodo excluir($id)
     * @param $id
     * @return boolean
     */
    public function excluir($id) {
        // INSTRUCAO SQL //
        $sql = "UPDATE " . $this->tabela . " SET excluido = 1 WHERE id = '" . $id . "'";
        // EXECUTANDO A SQL //
        $resultado = $this->conexao->exec($sql);
        // RETORNANDO O RESULTADO //
        return $resultado;
    }
    
    
    /**
     * Metodo buscarPorId($id)
     * @param $campo da tabela que sera pesquisado
     * @param $valor do campo da tabela que sera pesquisado
     * @return fetch_assoc
     */
    public function buscarPorCampo($campo, $valor) {
        // INSTRUCAO SQL //
        $sql = "SELECT u.".$campo." FROM " . $this->tabela . " u WHERE u.".$campo." = '" . $valor . "'";
        // EXECUTANDO A SQL //
        $resultado = $this->conexao->fetch($sql);
        // RETORNANDO O RESULTADO //
        return $resultado;
    }
    
    
    /**
     * Metodo buscarPorId($id)
     * @param $id
     * @return fetch_assoc
     */
    public function buscarPorId($id) {
        // INSTRUCAO SQL //
        $sql = "SELECT u.* FROM " . $this->tabela . " u WHERE u.id = '" . $id . "'";
        // EXECUTANDO A SQL //
        $resultado = $this->conexao->fetch($sql);
        // RETORNANDO O RESULTADO //
        return $resultado;
    }
    
    
    
    
    /**
     * Metodo listar($ordenarPor)
     * @param $ordenarPor - variavel que indica qual culuna utilizada no ordenamento
     * @return fetch_assoc[]
     */    
    public function listar($ordenarPor) {
        // INSTRUCAO SQL //
        $sql = "SELECT u.* FROM " . $this->tabela . " u ORDER BY u.".$ordenarPor."";
        // EXECUTANDO A SQL //
        $resultado = $this->conexao->fetchAll($sql);
        // RETORNANDO O RESULTADO //
        return $resultado;
    }
}

?>
