<?php
class  ModuloCobtroll extends controll{
	const MODULO = 1;
	
	/**
	 * Acao index()
	 */
	public function index(){
		// código da ação serve para o controle de acesso//
		static $acao = 1;
		// definindo a tela //
		$this->setTela('listar',array('modulo'));
		// guardando a url //
		$this->getPage();
	}
	
	/**
	 * Acao ver($id)
	 * @param $id
	 */
	public function ver($id){
		// código da ação serve para o controle de acesso//
		static $acao = 1;
		// buscando o usuário //
		$modulo = Modulo::buscar($id);
		// jogando o usuário no atributo $dados do controlador //
		$this->setDados($modulo,'VIEW');
		// definindo a tela //
		$this->setTela('ver',array('modulo'));
	}
}

?>