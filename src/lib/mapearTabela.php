<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of hiberneiteMeu
 *
 * @author softluc
 */
class mapearTabela {
    //put your code here
    private $nomeTabela;
    private $arrayEstruturaTabela;
    
    public function __construct($nomeTabela = null){
        
        $this->nomeTabela = $nomeTabela;
        
               
        include_once("class_mysql.php");

        $mySQL = new MySQL;
        $mySQL->connMySQL();

        $sql = 'DESCRIBE '.$this->nomeTabela;

        $returnSQL = $mySQL->runQuery($sql);
        
        $dadosTabela = array();
        $count = 0;

        while ($infSQL = mysql_fetch_assoc($returnSQL)){

            $dadosTabela[$count]['campo'] = $infSQL['Field'];
            $dadosTabela[$count]['tipo'] = $infSQL['Type'];
            $count++;

        }
        
        $this->setArrayEstruturaTabela($dadosTabela);
        
    }
    
    public function getNomeTabela(){
	return $this->nomeTabela;
    }
    
    public function getArrayEstruturaTabela(){
	return $this->arrayEstruturaTabela;
    }
}
?>
