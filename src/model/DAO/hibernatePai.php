<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of hibernatePai
 *
 * @author softluc
 */
class hibernatePai {
    //put your code here
    private $nomeTabela;
    private $constanteEstruturaTabela;
    
    
    
    public function __construct($nomeTabela = null, $constanteEstruturaTabela = null){
        
        $this->nomeTabela = $nomeTabela;
        $this->constanteEstruturaTabela = $constanteEstruturaTabela;
        
    }
    
    public function carregarDados(){
        
        $mapearTabela = new mapearTabela($this->getNomeTabela());
        $this->setConstanteEstruturaTabela($mapearTabela->getArrayEstruturaTabela());
        
    }
    
    
    public function getNomeTabela(){
	return $this->nomeTabela;
    }
    public function setNomeTabela($nomeTabela){
        $this->nomeTabela = $nomeTabela;
    }
    
    public function getConstanteEstruturaTabela(){
	return $this->constanteEstruturaTabela;
    }
    private function setConstanteEstruturaTabela($constanteEstruturaTabela){
        $this->constanteEstruturaTabela = $constanteEstruturaTabela;
    }
    
    
}

?>
