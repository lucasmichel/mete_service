<?php
 class TermoServicoControll extends Controll{
 	const MODULO = 12;
 	/**
 	 * Acao index()
 	 */
 	public function index(){
 		// código da ação serve para o controle de acesso//
 		static $acao = 1;
 		// definindo a tela //
 		$this->setTela('listar',array('termoAdesao'));
 		// guardando a url //
 		$this->getPage();
 	}
 	
 	public function acaoVer($id){
 		// código da ação serve para o controle de acesso//
 		static $acao = 5;
 		// definindo a tela //
 	
 		$modulo = Modulo::buscar($id);
 		$this->setDados($modulo,'termoAdesaoo');
 		$this->setTela('ver',array('termoAdesaoo'));
 		// guardando a url //
 		$this->getPage();
 	}
 	public function acaoAdd($id){
 		// código da ação serve para o controle de acesso//
 		static $acao = 6;
 		// checando se o formulário nao foi passado //
 	
 	
 		if(!$this->getDados('POST')) {
 			//  definindo a  tela //
 			$modulo = Modulo::buscar($id);
 			$this->setDados($modulo,'termoServico');
 			$this->setTela('add',array('termoServico'));
 		} else {
 			// caso passar o formulário //
 			// chamando o metodo privado _add() passando os dados do post por parametro //
 			$this->_acaoAdd($this->getDados('POST'));
 		}
 	
 	}
 	
 }

?>